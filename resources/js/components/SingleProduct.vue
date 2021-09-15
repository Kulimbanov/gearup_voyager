<template>
    <div class="container">
        <div class="py-5 row">
            <div class="col-lg-6">
                <div class="single-product-gallery">
                    <div class="single-product-gallery-card">
                        <div class="image" v-for="image in gallery"
                             :style="'background-image: url('+ getImage(image)+ ')'"></div>
                    </div>
                </div>
                <div class="single-product-gallery-price">
                    <div class="value">{{ page.price }}.mkd</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-product-description">
                    <h2>{{ page.title }}</h2>
                    <h3>{{ page.category }}</h3>


                    <h3 v-for="brand in brands">{{ brand.name }}</h3>

                </div>
            </div>
        </div>
        <div class="container my-4">
            <div class="card-columns">
                <!--            <product-property class="card border-0 text-white" :property="property"></product-property>-->
                <div class="card border-0 text-white" v-for="property in properties" :key="property.id">
                    <img class="card-img rounded-0" src="https://source.unsplash.com/5e9CmF-Ge9Y/540">
                    <div class="card-img-overlay p-0">
                        <div class="card-block">
                            <h5 class="card-title">{{ property.name }}<a class="stretched-link" href="#"></a></h5>
                            <p class="card-text">{{ property.value }}</p><small class="text-mutted">#space</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    name: "SingleProduct",
    props: {
        page: null,
        properties: null,
        brands: null,
        gallery: null,
    },

    data() {
        return {}
    },
    components: {
        // ProductProperty
    },
    methods: {
        getImage(image) {
            return process.env.MIX_APP_API + "/storage/" + image;
        },
    },
    created() {
        console.log(this.page);
        console.log(this.properties);
        console.log(this.brands);
        console.log(this.gallery);
    }

}
</script>

<style scoped>

</style>
