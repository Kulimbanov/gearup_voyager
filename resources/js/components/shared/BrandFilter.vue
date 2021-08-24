<template>
    <div class="brands-filter">
        <div class="form-check form-switch" v-for="brand in brands">
            <input class="form-check-input" type="checkbox" :value="brand" v-model="checkedBrands"
                   @change="setBrandFilter">
            <label class=" form-check-label" :for="brand">
                {{ brand }}
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "BrandFilter",
    props: {
        brands: [],
    },
    data() {
        return {
            checkedBrands: this.brands
        }
    },
    methods: {
        setBrandFilter() {
            console.log('setBrandFilter');
            this.$emit('setBrandFilter', this.checkedBrands);
        }
    }

}
</script>

<style scoped>

</style>
