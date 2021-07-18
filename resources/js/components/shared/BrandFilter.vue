<template>
    <div class="card">
        <div class="form-check form-switch" v-for="brand in brands">
            <input class="form-check-input" type="checkbox" :id="brand" checked>
            <label class="form-check-label" :for="brand">
                {{ brand }}
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "BrandFilter",
    props: {
        brands: []
    }

}
</script>

<style scoped>

</style>
