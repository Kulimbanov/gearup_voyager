<template>
    <div class="container">
        <div id="service-scene"></div>
        <Modal
            v-show="isRepairmentVisible"
            @close="closeServiceDetails">
            <template v-slot:header> {{ repairment.name }}</template>
            <template v-slot:body> {{ repairment.description }}</template>
            <template v-slot:footer> {{ repairment.price }}</template>
        </Modal>
    </div>
</template>

<script>
import Vue from "vue";
import * as THREE from 'three'
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import {OBJLoader} from 'three/examples/jsm/loaders/OBJLoader.js';
import {MTLLoader} from 'three/examples/jsm/loaders/MTLLoader.js';
import Modal from './shared/Modal';

Vue.prototype.THREE = THREE

const rotationSpeed = 0.003;
export default {
    name: 'Services',
    components: {
        Modal,
    },
    data() {
        return {
            bike: null,
            renderer: null,
            scene: null,
            camera: null,
            width: 0,
            height: 0,
            mtlLoader: MTLLoader,
            objLoader: OBJLoader,
            raycaster: null,
            mouse: null,
            light: null,
            plane: null,
            isRepairmentVisible: false,
            repairment: [],
        }
    },
    methods: {
        init: function () {
            this.scene = new THREE.Scene()
            this.camera = new THREE.PerspectiveCamera(
                45,
                window.innerWidth / window.innerHeight,
                0.1,
                5
            );
            this.camera.position.set(-1, 0, 1); // Set position like this
            // this.camera.lookAt(new THREE.Vector3(1, 0, 0)); // Set look at coordinate like this

            this.raycaster = new THREE.Raycaster();
            this.mouse = new THREE.Vector2();

            this.renderer = new THREE.WebGLRenderer()
            this.renderer.shadowMap.enabled = true;
            this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            this.onWindowResize();
            let container = document.getElementById('service-scene');
            container.appendChild(this.renderer.domElement)
            container.addEventListener('click', this.select, false)
            container.addEventListener('touchstart', this.touchSelect, false)

            const controls = new OrbitControls(this.camera, this.renderer.domElement);
            controls.addEventListener('change', this.render);
            controls.minDistance = 3;
            controls.maxDistance = 3;
            controls.minPolarAngle = 0;
            controls.enablePan = false;
            controls.maxPolarAngle = Math.PI * 0.5;

            const ambientLight = new THREE.AmbientLight(0xf8fafc, 0.5);
            this.scene.add(ambientLight);

            // const pointLight = new THREE.PointLight(0xf8f9fa, 0.3);
            // this.camera.add(pointLight);

            this.light = new THREE.DirectionalLight(0xf8fafc, 0.7, 10);
            // this.light.position.set(0, 1, 0);
            this.light.castShadow = true;
            this.scene.add(this.light);

            this.scene.background = new THREE.Color(0xf8fafc);
            this.scene.add(this.camera);
        },
        animate: function () {
            requestAnimationFrame(this.render.bind(this))
            if (this.bike !== null) {
                this.bike.rotation.y += rotationSpeed
            }
            this.render()
        },
        render: function () {
            this.light.position.copy(this.camera.position);
            this.plane.position.copy(new THREE.Vector3(0, -0.525, 0));
            this.renderer.render(this.scene, this.camera)
        },
        onWindowResize: function () {
            this.calculateSize();
            this.camera.updateProjectionMatrix();
            this.camera.aspect = this.width / this.height;
            this.renderer.setPixelRatio(window.devicePixelRatio);
            this.renderer.setSize(this.width, this.height);
        },
        calculateSize: function () {
            this.width = document.getElementById('service-scene').clientWidth;
            this.height = window.innerHeight / 1.85;
        },
        onProgress: function (xhr) {
            if (xhr.lengthComputable) {
                let percentComplete = xhr.loaded / xhr.total * 100;
                console.log(Math.round(percentComplete, 2) + '% downloaded');
            }
        },
        onError: function (xhr) {
        },
        loadObjects: function () {
            let self = this;
            new MTLLoader()
                .setPath('/assets/models/')
                .load('manual-bike-import.mtl', materials => {
                    materials.preload();
                    new OBJLoader()
                        .setMaterials(materials)
                        .setPath('/assets/models/')
                        .load('manual-bike-import.obj', function (object) {

                            object.position.y = 0;
                            self.bike = object
                            for (let k in object.children) {
                                object.children[k].castShadow = true;
                                object.children[k].receiveShadow = true;
                            }
                            self.scene.add(object)

                        }, self.onProgress, self.onError);
                });

            const planeGeometry = new THREE.PlaneGeometry(20, 20);
            planeGeometry.rotateX(-Math.PI / 2);
            const planeMaterial = new THREE.MeshStandardMaterial({color: 0xf8f9fa})
            this.plane = new THREE.Mesh(planeGeometry, planeMaterial);
            this.plane.position.y = -0.525;
            this.plane.receiveShadow = true;
            // this.scene.add(this.plane);
        },
        touchSelect: function (e) {
            const rect = this.renderer.domElement.getBoundingClientRect();
            this.mouse.x = ((e.touches[0].clientX - rect.left) / (rect.right - rect.left)) * 2 - 1;
            this.mouse.y = -((e.touches[0].clientY - rect.top) / (rect.bottom - rect.top)) * 2 + 1;
            this.showServiceDetails()
        },
        select: function (e) {
            const rect = this.renderer.domElement.getBoundingClientRect();
            this.mouse.x = ((e.clientX - rect.left) / (rect.right - rect.left)) * 2 - 1;
            this.mouse.y = -((e.clientY - rect.top) / (rect.bottom - rect.top)) * 2 + 1;
            this.showServiceDetails()
        },
        showServiceDetails: function () {
            this.raycaster.setFromCamera(this.mouse, this.camera);
            let intersects = this.raycaster.intersectObjects(this.scene.children, true);
            if (intersects[0].object && intersects[0].object.name) {
                this.$http.get('/api/services/?name=' + intersects[0].object.name)
                    .then(response => {
                        this.repairment = response.data;
                        this.isRepairmentVisible = true;
                    });
            }
        },
        closeServiceDetails: function () {
            this.isRepairmentVisible = false;
        }
    }, created() {
        this.onProgress = this.onProgress.bind(this)
        this.onError = this.onError.bind(this)
        this.select = this.select.bind(this)
        this.touchSelect = this.touchSelect.bind(this)
        window.addEventListener("resize", this.onWindowResize);
    },
    destroyed() {
        window.removeEventListener("resize", this.onWindowResize);
    },
    mounted() {
        this.init()
        this.loadObjects()
        this.animate()
    }
}
</script>

<style scoped>
#service-scene {
    width: 100%;
    display: block;
}
</style>
