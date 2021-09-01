<template>
    <div class="row category-products">
        <div class="col-md-3 category-products-filters">
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
        <div class="col-md-9 category-products-container">
            <div class="container mb-5 mt-5 pb-3">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-1"
                         v-for="product in filterProducts"
                         :key="product.id">

                        <div class="product">
                            <div class="product-tag-sale" v-if="product.featured"></div>
                            <div class="product-image">
                                <span class="product-image-hover-link"></span>
                                <a :href="getProductLink(product.categorySlug,product.slug)" class="product-image-link">details</a>
                                <img class="img-responsive" :src="getImage(product.image)" alt="">
                            </div>
                            <div class="product-description">
                                <div class="product-description-label">
                                    <div class="product-description-label-name">
                                        <div class="title">{{ product.name }}</div>
                                        <p class="price">{{ product.price }}.mkd</p>
                                        <p class="sub-title">{{ product.brands }}</p>
                                    </div>
                                </div>
                                <div class="product-description-option" v-if="product.properties.count > 0">
                                    <div class="product-description-size" v-for="property in product.properties">
                                        <h3>{{ property.name }}</h3>
                                        <p>{{ property.value }}</p>
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
        getProductLink(categorySlug, productSlug) {
            return process.env.MIX_APP_API + "/shop/" + categorySlug + '/' + productSlug;
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
