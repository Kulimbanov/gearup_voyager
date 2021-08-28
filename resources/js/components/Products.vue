<template>

    <div class="row">
        <div class="col-md-3">
            <div class="pb-3 px-3">

                <h3 class="mt-5">Filters</h3>
                <div class="row">
                    <div class="container mb-5 mt-5" v-if="showPriceFilter">
                        <h4 class="mb-5">Price</h4>
                        <price-filter
                            v-model="minPrice"
                            :minInput="minPrice"
                            :maxInput="maxPrice"
                            @setPriceRange="productsInPriceRange">
                        </price-filter>
                    </div>
                    <div class="container mb-5 mt-5" v-if="showBrandFilter">
                        <h4 class="mb-5">Brands</h4>
                        <brand-filter
                            :brands="brands"
                            @setBrandFilter="productsInBrand">
                        </brand-filter>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="pb-3">
                <div class="container mb-5 mt-5">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1"
                             v-for="product in filterProducts"
                             :key="product.id">
                            <div class="card mt-3" v-on:click="showProductCardPrice(product)">
                                <div class="product align-items-center p-2 text-center">
                                    <img :src="getImage(product.image)" class="rounded" width="160">
                                    <h5 class="name">{{ product.name }}</h5>
                                    <div class="mt-3 info">
                                        <span class="text1 d-block" v-for="brand in JSON.parse(product.brand)">
                                            {{ brand }}
                                        </span>
                                    </div>
                                    <div class=" star mt-3 align-items-center">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div v-show="product.show"
                                     class="p-3 bg-danger text-center text-white mt-3 cursor card-expand">
                                    <div class=" cost mt-3 text-dark">
                                        <span>{{ product.price }}</span>
                                    </div>
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
import BrandFilter from './shared/BrandFilter';

const axios = require('axios');

export default {
    props: ['category_id'],
    data() {
        return {
            showPriceFilter: false,
            showBrandFilter: false,

            products: [],

            minPrice: null,
            maxPrice: null,

            brands: [],
            checkedBrands: [],
        }
    },
    components: {
        PriceFilter,
        BrandFilter
    },
    methods: {
        getImage(image) {
            return process.env.MIX_APP_API + "/storage/" + image;
        },
        getProductLink(slug) {
            return process.env.MIX_APP_API + "/shop/" + slug;
        },
        setDefaultPriceRange() {
            this.maxPrice = this.products.reduce((max, product) => (max === undefined || max > product.price) ? max : product.price, this.products[0].price);
            this.minPrice = this.products.reduce((min, product) => (min === undefined || min < product.price) ? min : product.price, this.products[0].price);
            this.showPriceFilter = this.maxPrice !== null && this.minPrice !== null;
        },
        setDefaultBrands() {
            this.products.map(product => JSON.parse(product.brand).map(b => this.brands.indexOf(b) === -1 ? this.brands.push(b) : ''))
            this.checkedBrands = this.brands
            this.showBrandFilter = this.brands.length !== 0;
        },
        productsInPriceRange(minValue, maxValue) {
            this.minPrice = minValue;
            this.maxPrice = maxValue;
        },
        productsInBrand(checkedBrands) {
            this.checkedBrands = checkedBrands;
        },
        showProductCardPrice(product) {
            product.show = (typeof (product.show) == 'undefined') || (!product.show);
        }
    },
    created() {
        this.$http.get(process.env.MIX_APP_API + '/api/products/?category_id=' + this.category_id)
            .then(response => {
                this.products = response.data;
                this.setDefaultPriceRange();
                this.setDefaultBrands();
            });
    },
    computed: {
        filterProducts() {
            return this.products.filter(product => (product.price >= this.minPrice && product.price <= this.maxPrice))
                .filter(product => JSON.parse(product.brand).some(brand => this.checkedBrands.includes(brand)));
        }
    }
}

</script>
