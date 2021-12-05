<template>
    <div class="container our-partners mb-5">
        <div class="w-100">
            <!--            <h3 class="m-1">Our Partners</h3>-->

            <div class="d-flex justify-space-around align-center">

                <div class="m-auto" v-for="partner in partners" :key="partner.id">
                    <a class="link" :href="partner.url" :title="partner.name">
                        <div class="cover">
                            <img :src="getImage(partner.logo)" class="rounded" width="160"/>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

const axios = require('axios');

export default {
    data() {
        return {
            partners: [],
        }
    },
    methods: {
        getImage(image) {
            return process.env.MIX_APP_API + "/storage/" + image;
        }
    },
    created() {
        this.$http.get(process.env.MIX_APP_API + '/api/partners')
            .then(response => {
                this.partners = response.data;
            });
    }
}

</script>
