<template>
    <div class="weather" v-if="!loading">
        <h5 class="wrapper-city">{{ city }}</h5>
        <span class="wrapper-temperature">{{ temperature }}</span>
        <div class="weather-icon" :style="iconStyle"></div>
    </div>
</template>

<script>
export default {
    name: "Weather",

    data: function () {
        return {
            loading: true,
            data: "",
            city: 'Skopje',
            icon: '',
            source: 'https://api.openweathermap.org/data/2.5/weather?q=Skopje&appid=3e063297e94dd304c5c79ae8fa17406e&units=metric&mode=json',
            temperature: '',

        };
    },
    created() {
        this.loadFile()
    },
    computed: {
        iconStyle() {
            return "border: medium none; width: 45px; height: 45px; background: url('https://api.openweathermap.org/img/w/" + this.icon + ".png') repeat scroll 0% 0% transparent;"
        }
    },
    methods: {
        loadFile() {
            let instance = axios.create();

            delete instance.defaults.headers.common['Accept'];
            delete instance.defaults.headers.common['X-Requested-With'];
            delete instance.defaults.headers.common['X-CSRF-TOKEN'];

            let self = this;
            instance.get(this.source)
                .then(function (response) {
                    self.data = response.data;
                    // console.log(response);
                    console.log(response.data.weather[0].icon);
                    self.icon = response.data.weather[0].icon;
                    self.temperature = response.data.main.temp;
                    self.loading = false;
                }).catch(errors => {
                console.error(errors);
            });
        },
    },
}
</script>

<style scoped>

</style>
