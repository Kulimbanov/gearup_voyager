<template>
    <div class="featured-container">
        <h2 class="text-center cover">Hot products</h2>
        <p class="text-muted mb-5 text-center">List of our featured hot products.</p>

        <div class="infinite">
            <div class="shadow"></div>
        </div>
        <carousel :perPageCustom="[[0, 1],[768, 2], [1024, 3], [1200, 4]]">
            <slide class="box box-4" v-for="product in products" :key="product.id">
                <div class="cover">
                    <img :src="getImage(product.image)" class="rounded" width="160">
                </div>
                <button class="border-animation">
                    <div>{{ product.name }}</div>
                </button>
            </slide>
        </carousel>
    </div>
</template>

<script>
import {Carousel, Slide} from 'vue-carousel';

export default {
    name: "Featured",
    components: {
        Carousel,
        Slide
    },
    data() {
        return {
            products: [],
        }
    },
    methods: {
        getImage(image) {
            return process.env.MIX_APP_API + "/storage/" + image;
        },
    },
    created() {
        this.$http.get(process.env.MIX_APP_API + '/api/products/featured')
            .then(response => {
                this.products = response.data;
            });
    },
}
</script>
