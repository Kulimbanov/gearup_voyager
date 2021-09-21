<template>
<div>
    {{page}}
</div>
</template>

<script>
export default {
    name: "Verified",
    props:{
        page :null
    },
    created() {
        setTimeout(()=>{
            window.location.assign("https://gearup.local");
        },5000);
    }
}
</script>

<style scoped>

</style>
