<template>
    <div>
        <h2 class="text-center">Products List {{ category_id }}</h2>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
            </tr>
            </tbody>
        </table>
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
    created() {
        this.$http.get('/api/products/?category_id=' + this.category_id)
            .then(response => {
                this.products = response.data;
            });
    }
}
</script>
