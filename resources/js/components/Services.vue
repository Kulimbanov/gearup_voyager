<template>
    <div class="container">
        <div id="service-scene"></div>
    </div>
</template>

<script>
import Vue from "vue";
import * as THREE from 'three'
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import {OBJLoader} from 'three/examples/jsm/loaders/OBJLoader.js';
import {MTLLoader} from 'three/examples/jsm/loaders/MTLLoader.js';

Vue.prototype.THREE = THREE

const rotationSpeed = 0.003;
export default {
    name: 'Services',
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
        }
    },
    methods: {
        init: function () {
            this.scene = new THREE.Scene()
            this.camera = new THREE.PerspectiveCamera(
                45,
                window.innerWidth / window.innerHeight,
                0.1,
                100
            )

            this.renderer = new THREE.WebGLRenderer()
            this.onWindowResize();
            let container = document.getElementById('service-scene');
            container.appendChild(this.renderer.domElement)
            this.renderer.domElement.addEventListener('click', this.select, false)
            this.renderer.domElement.addEventListener('touchstart', this.touchSelect, false)

            this.camera.position.set(5, 0, 0);
            this.camera.lookAt(0, 0, 0);

            const controls = new OrbitControls(this.camera, this.renderer.domElement);
            controls.addEventListener('change', this.render);
            controls.minDistance = 2;
            controls.maxDistance = 2;
            controls.enablePan = false;

            const ambientLight = new THREE.AmbientLight(0xFFFFFF, 0.6);
            this.scene.add(ambientLight);

            const pointLight = new THREE.PointLight(0xffffff, 0.3);
            this.camera.add(pointLight);

            this.scene.background = new THREE.Color(0xf8f9fa);
            this.scene.add(this.camera);

            this.mouse = new THREE.Vector2();
            this.raycast = new THREE.Raycaster();
        },
        animate: function () {
            // requestAnimationFrame(this.animate)
            requestAnimationFrame(this.render.bind(this))

            if (this.bike !== null)
                this.bike.rotation.y += rotationSpeed
            this.render()
        },
        render: function () {
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
            this.width = document.getElementById('service-scene').clientWidth - 1;
            this.height = window.innerHeight / 2;
        },
        onProgress: function (xhr) {
            // console.log(xhr)
            if (xhr.lengthComputable) {

                let percentComplete = xhr.loaded / xhr.total * 100;
                console.log(Math.round(percentComplete, 2) + '% downloaded');
                // play(Math.round(percentComplete, 2))

            }
        },
        onError: function (xhr) {
        },
        initLoaders: function () {
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
                            self.scene.add(object)

                        }, self.onProgress, self.onError);
                });
        },
        touchSelect: function (e) {
            const rect = this.renderer.domElement.getBoundingClientRect();
            this.mouse.x = ((e.touches[0].clientX - rect.left) / (rect.right - rect.left)) * 2 - 1;
            this.mouse.y = -((e.touches[0].clientY - rect.top) / (rect.bottom - rect.top)) * 2 + 1;
            console.log(this.mouse.x, this.mouse.y);
            this.raycaster.setFromCamera(this.mouse, this.camera);
            let intersects = this.raycaster.intersectObjects(this.scene.children, true);
            if (intersects.length > 0) {
                console.log(intersects);
            }
        },
        select: function (e) {
            const rect = this.renderer.domElement.getBoundingClientRect();
            this.mouse.x = ((e.clientX - rect.left) / (rect.right - rect.left)) * 2 - 1;
            this.mouse.y = -((e.clientY - rect.top) / (rect.bottom - rect.top)) * 2 + 1;
            console.log(this.mouse.x, this.mouse.y);
            this.raycaster.setFromCamera(this.mouse, this.camera);
            let intersects = this.raycaster.intersectObjects(this.scene.children, true);
            if (intersects.length > 0) {
                console.log(intersects);
            }
        },
    }, created() {
        this.onProgress = this.onProgress.bind(this)
        this.onError = this.onError.bind(this)
        window.addEventListener("resize", this.onWindowResize);
    },
    destroyed() {
        window.removeEventListener("resize", this.onWindowResize);
    },
    mounted() {
        this.init()
        this.initLoaders()
        this.animate()
    }
}
</script>

<style scoped>

</style>
