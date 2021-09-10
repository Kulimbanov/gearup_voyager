<template>
    <div>
        <div v-for="property in properties" :key="property.id">
            <div class="row pt-5 property">
                <product-property :property="property"></product-property>
            </div>
        </div>
    </div>
</template>


<script>

import ProductProperty from "./shared/ProductProperty";

export default {
    name: "SingleProduct",
    props: {
        page: null
    },

    data() {
        return {
            properties: []
        }
    },
    components: {
        ProductProperty
    },
    created() {
        this.properties = this.page;
        console.log(this.properties);
        console.log(this.page);
    }

}
</script>

<style scoped>

</style>
