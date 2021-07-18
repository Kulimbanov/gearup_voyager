<template>

    <div class="row">
        <div class="col-md-3">
            <div class="pb-3 px-3">

                <h3 class="mt-5">Filters</h3>
                <div class="row">
                    <div class="container mb-5 mt-5">
                        <h4 class="mb-5">Price</h4>
                        <price-filter
                            v-if="!loading"
                            v-model="minPrice"
                            :minInput="minPrice"
                            :maxInput="maxPrice"
                            @setPriceRange="productsInPriceRange">
                        </price-filter>
                    </div>
                    <div class="container mb-5 mt-5">
                        <h4 class="mb-5">Brands</h4>
                        <div class="form-check form-switch" v-for="brand in brands">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                {{ brand }}
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="pb-3">
                <div class="container mb-5 mt-5">
                    <div class="row">
                        <div class="col-md-4" v-for="product in filterProducts" :key="product.id">
                            <div class="card mt-3">
                                <div class="product-1 align-items-center p-2 text-center">
                                    <img :src="getImage(product.image)" class="rounded" width="160">
                                    <h5>{{ product.name }}</h5>
                                    <div class="mt-3 info"><span class="text1 d-block">{{ product.brand }}</span></div>
                                    <div class=" cost mt-3 text-dark"><span>{{ product.price }}</span>
                                        <div class=" star mt-3 align-items-center"><i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i
                                            class="fa fa-star"></i></div>
                                    </div>
                                </div>
                                <div class="p-3 bg-danger text-center text-white mt-3 cursor"><span
                                    class="text-uppercase">Add to cart</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import PriceFilter from './shared/PriceFilter';

const axios = require('axios');

export default {
    props: ['category_id'],
    data() {
        return {
            loading: true,
            products: [],
            minPrice: null,
            maxPrice: null,
            brands: [],
        }
    },
    components: {
        PriceFilter
    },
    methods: {
        getImage(image) {
            return "/storage/" + image;
        },
        setDefaultPriceRange() {
            this.maxPrice = this.products.reduce((max, product) => (max === undefined || max > product.price) ? max : product.price, this.products[0].price);
            this.minPrice = this.products.reduce((min, product) => (min === undefined || min < product.price) ? min : product.price, this.products[0].price);
        },
        setDefaultBrands() {
            this.brands = this.products.map(product => product.brand);
        },
        productsInPriceRange(minValue, maxValue) {
            this.minPrice = minValue;
            this.maxPrice = maxValue;
        }
    },
    created() {
        this.$http.get('/api/products/?category_id=' + this.category_id)
            .then(response => {
                this.products = response.data;
                this.setDefaultPriceRange();
                this.setDefaultBrands();
                this.loading = false;
            });
    },
    computed: {
        filterProducts() {
            return this.products.filter(product => (product.price >= this.minPrice && product.price <= this.maxPrice));
        }
    }
}
</script>
