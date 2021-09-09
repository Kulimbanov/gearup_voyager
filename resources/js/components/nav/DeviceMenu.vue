<template>
    <div id="nav-trigger" @click="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</template>

<script>
export default {
    name: "DeviceMenu",

    data() {
        return {
            toggled: false,
            menu: null,
            trigger: null
        }
    },
    mounted() {
        this.menu = document.getElementsByClassName('menu')[0];
        this.trigger = document.getElementById('nav-trigger');
    },

    methods: {
        toggleMenu() {
            if (!this.toggled) {
                this.toggled = true;
                this.trigger.classList.add('open');
                this.menu.classList.add('active');
            } else {
                this.toggled = false;
                this.trigger.classList.remove('open');
                this.menu.classList.remove('active');
            }
        }
    }
}
</script>
