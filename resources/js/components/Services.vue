<template>
    <div class="container">
        <div id="service-scene"></div>
    </div>
</template>

<script>
import * as THREE from 'three'
import {MTLLoader, OBJLoader} from 'three-obj-mtl-loader'
import {OrbitControls} from "three/examples/jsm/controls/OrbitControls";

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
        }
    },
    methods: {
        init: function () {
            this.scene = new THREE.Scene()
            this.camera = new THREE.PerspectiveCamera(
                75,
                window.innerWidth / window.innerHeight,
                0.1,
                1000
            )

            this.renderer = new THREE.WebGLRenderer()
            this.onWindowResize();
            let container = document.getElementById('service-scene');
            container.appendChild(this.renderer.domElement)

            this.camera.position.z = 5

            const controls = new OrbitControls(this.camera, this.renderer.domElement);
            controls.addEventListener('change', this.render);
            controls.minDistance = 1;
            controls.maxDistance = 20;
            controls.enablePan = false;

            const ambientLight = new THREE.AmbientLight(0xFFFFFF, 1);
            this.scene.add(ambientLight);

            const pointLight = new THREE.PointLight(0xffffff, 0.9);
            this.camera.add(pointLight);

            this.scene.background = new THREE.Color(0xF5F9F8);
            this.scene.add(this.camera);

            const animate = function () {
            }
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
            this.renderer.setSize(this.width, this.height);
        },
        calculateSize: function () {
            this.width = document.getElementById('service-scene').clientWidth - 1;
            this.height = window.innerHeight / 2;
        },
        onProgress: function (xhr) {
            console.log(xhr)
            if (xhr.lengthComputable) {

                var percentComplete = xhr.loaded / xhr.total * 100;
                console.log(Math.round(percentComplete, 2) + '% downloaded');
                // play(Math.round(percentComplete, 2))

            }
        },
        onError: function (xhr) {
        },
        initLoaders: function () {
            let self = this;
            self.mtlLoader = new MTLLoader()
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
    }, created() {
        window.addEventListener("resize", this.onWindowResize);
        this.onProgress = this.onProgress.bind(this)
        this.onError = this.onError.bind(this)
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
