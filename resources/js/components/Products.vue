<template>
    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-md-4" v-for="product in products" :key="product.id">
                <div class="card mt-3">
                    <div class="product-1 align-items-center p-2 text-center"><img :src="getImage(product.image)"
                                                                                   class="rounded" width="160">
                        <h5>{{ product.name }}</h5>
                        <div class="mt-3 info"><span class="text1 d-block">{{ product.brand }}</span></div>
                        <div class=" cost mt-3 text-dark"><span>{{ product.price }}</span>
                            <div class=" star mt-3 align-items-center"><i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i></div>
                        </div>
                    </div>
                    <div class="p-3 bg-danger text-center text-white mt-3 cursor"><span class="text-uppercase">Add to cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const axios = require('axios');

export default {
    props: ['category_id'],
    data() {
        return {
            products: []
        }
    },
    methods: {
        getImage(image) {
            return "/storage/" + image;
        },
    },
    created() {
        this.$http.get('/api/products/?category_id=' + this.category_id)
            .then(response => {
                this.products = response.data;
            });
    }
}
</script>
