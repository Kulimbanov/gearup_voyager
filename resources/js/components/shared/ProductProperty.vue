<template>
    <div class="card border-0 text-white">
        <!--                <img class="card-img rounded-0" src="https://source.unsplash.com/dBaz0xhCkPY/540">-->
        <img class="card-img rounded-0" src="https://source.unsplash.com/5e9CmF-Ge9Y/540">
        <div class="card-img-overlay p-0">
            <div class="card-block">
                <h5 class="card-title">{{ property.name }}<a class="stretched-link" href="#"></a></h5>
                <p class="card-text">{{ property.value }}</p><small class="text-mutted">#space</small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductProperty",
    props: {
        property: []
    },
    created() {
        const type = this.property.type;

        console.log(type);
        switch (type) {
            case "int":
                console.log("Uh oh.");
                break;
            case "text":
                console.log("A good day for golf!");
                break;
            default:
                console.log("Try looking up for a hint.");
        }

    },
    methods: {}
}
</script>
