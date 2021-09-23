<template>
    <div>
        <b-alert
            variant="danger"
            dismissible
            fade
            :show="showDismissibleAlert"
            @dismissed="showDismissibleAlert=false"
        >
            {{ info }}
        </b-alert>
    </div>
    <!--    <div class="user-modal-container" :class="{ 'active': active }" @click="close" id="message-modal">-->
    <!--        <div class="user-modal">-->
    <!--            <div class="message" :class="{ 'active': active }" id="form-message">-->
    <!--                {{ info }}-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
</template>

<script>
export default {
    name: "Message",
    props: {
        active: false,
        info: ''
    },
    methods: {
        close(e) {
            if (e.target.id === 'message-modal')
                this.$emit('toggleModal', 'message');
        },
    }
}
</script>

<style scoped>

</style>
