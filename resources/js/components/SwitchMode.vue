<template>
    <div class="toggle">
        <toggle-button
            @change="triggerToggleEvent"
            :labels="{checked: 'Light', unchecked: 'Dark'}"
            :value="currentMode"
            :css-colors="true"
            :width="72"
            :height="36"
        />
    </div>
</template>

<script>
import {ToggleButton} from 'vue-js-toggle-button'

export default {
    name: 'SwitchMode',

    components: {
        ToggleButton
    },

    computed: {
        currentMode: function () {
            this.setBodyClass();
            return this.getCurrentMode();
        }
    },

    methods: {
        getCurrentMode() {
            return (this.$cookie.get('mode') === 'true');
        },
        triggerToggleEvent() {
            this.$cookie.set('mode', !this.getCurrentMode(), 1);
            this.setBodyClass();
        },
        setBodyClass() {
            if (this.getCurrentMode())
                document.body.classList.add('dark')
            else
                document.body.classList.remove('dark')
        }
    }
}
</script>
