<template>
    <toggle-button @change="triggerToggleEvent" :value="toggleActive"/>
</template>

<script>
import {ToggleButton} from 'vue-js-toggle-button'

export default {
    name: 'SwitchMode',

    components: {
        ToggleButton
    },

    computed: {
        toggleActive: function () {
            return this.isDarkMode();
        }
    },

    methods: {
        isDarkMode() {
            return this.$cookie.get('mode') === 'true';
        },
        triggerToggleEvent() {
            this.$cookie.set('mode', !this.isDarkMode(), 1);
            this.setClass();
        },
        setClass() {
            if (this.isDarkMode())
                document.body.classList.add('dark')
            else
                document.body.classList.remove('dark')
        }
    }
}
</script>
