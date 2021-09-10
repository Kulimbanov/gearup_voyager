<template>
    <div>
        <h3>{{ property.name }}</h3>
        <p>{{ property.value }}</p>
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
