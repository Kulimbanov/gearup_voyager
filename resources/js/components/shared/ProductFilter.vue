<template>
    <vue-range-slider ref="slider" v-model="value"></vue-range-slider>
</template>

<script>
import 'vue-range-component/dist/vue-range-slider.css'
import VueRangeSlider from 'vue-range-component'

export default {
    name: "ProductFilter",
    show: {
        type: Boolean,
        default: true
    },
    value: {
        type: [String, Number, Array, Object],
        default: 0
    },
    min: {
        type: Number,
        default: 0
    },
    max: {
        type: Number,
        default: 100
    },
    step: {
        type: Number,
        default: 1
    },
    width: {
        type: [Number, String],
        default: 'auto'
    },
    height: {
        type: [Number, String],
        default: 6
    },
    dotSize: {
        type: Number,
        default: 16
    },
    dotWidth: {
        type: Number,
        required: false
    },
    dotHeight: {
        type: Number,
        required: false
    },
    stopPropagation: {
        type: Boolean,
        default: false
    },
    eventType: {
        type: String,
        default: 'auto'
    },
    realTime: {
        type: Boolean,
        default: false
    },
    tooltip: {
        type: [String, Boolean],
        default: 'always',
        validator(val) {
            return ['hover', 'always', false].indexOf(val) > -1
        }
    },
    direction: {
        type: String,
        default: 'horizontal',
        validator(val) {
            return ['horizontal', 'vertical'].indexOf(val) > -1
        }
    },
    reverse: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: [Boolean, Array],
        default: false
    },
    piecewiseLabel: {
        type: Boolean,
        default: false
    },
    piecewise: {
        type: Boolean,
        default: false
    },
    processDraggable: {
        type: Boolean,
        default: false
    },
    clickable: {
        type: Boolean,
        default: true
    },
    fixed: {
        type: Boolean,
        default: false
    },
    debug: {
        type: Boolean,
        default: true
    },
    minRange: {
        type: Number
    },
    maxRange: {
        type: Number
    },
    tooltipMerge: {
        type: Boolean,
        default: true
    },
    startAnimation: {
        type: Boolean,
        default: false
    },
    lazy: {
        type: Boolean,
        default: false
    },
    enableCross: {
        type: Boolean,
        default: true
    },
    speed: {
        type: Number,
        default: 0.5
    },
    useKeyboard: {
        type: Boolean,
        default: false
    },
    actionsKeyboard: {
        type: Array,
        default() {
            return [(i) => i - 1, (i) => i + 1]
        }
    },
    formatter: [String, Function],
    mergeFormatter: [String, Function],
    tooltipDir: [Array, String],
    tooltipStyle: [Array, Object, Function],
    sliderStyle: [Array, Object, Function],
    focusStyle: [Array, Object, Function],
    disabledStyle: Object,
    processStyle: Object,
    bgStyle: Object,
    piecewiseStyle: Object,
    piecewiseActiveStyle: Object,
    disabledDotStyle: [Array, Object, Function],
    labelStyle: Object,
    labelActiveStyle: Object,
    data() {
        return {
            value: [1,10]
        }
    },
    components: {
        VueRangeSlider
    }
}
</script>

<style scoped>

</style>
