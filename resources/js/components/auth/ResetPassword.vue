<template>
    <div class="user-modal-container" :class="{ 'active': active }" @click="close($event)" id="reset-modal">
        <div class="user-modal">
            <div class="form-login" :class="{ 'active': active }" id="form-reset">
                <div class="error-message" v-text="resetTittle"></div>
                <input type="text" name="user" disabled placeholder="Email" v-model="user.email"
                       @keyup.enter="resetSubmit">
                <input type="password" name="password" placeholder="Password" v-model="user.password"
                       @keyup.enter="resetSubmit">

                <input type="password" name="password_confirmation" placeholder="Confirm password"
                       v-model="user.password_confirmation"
                       @keyup.enter="resetSubmit">

                <input type="submit" :class="{ 'disabled': !valid }" @click.prevent="resetSubmit"
                       v-model="this.resetButton" id="resetSubmit">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ResetPassword",
    props: {
        active: false,
        email: '',
        message: '',
    },
    data() {
        return {
            user: {
                email: '',
                password: '',
                password_confirmation: '',
            },
            resetButton: 'Reset',
        }
    },
    created() {
        this.user.email = this.email;
    },
    computed: {
        valid() {
            return this.user.password !== '' && this.user.password === this.user.password_confirmation;
        },
        resetTittle() {

            if (this.user.password.length < 8) {
                return 'Password needs 8 or more characters';
            } else if (!this.valid) {
                return 'Confirm password does not match';
            }
            if (this.message) {
                this.resetButton = 'Reset';
                return this.message;
            }
            if (this.resetButton === 'Sending...') {
                return 'Just a moment';
            }
        }
    },
    methods: {
        close(e) {
            if (e.target.id === 'reset-modal')
                this.$emit('toggleModal', 'resetPassword');
        },

        resetSubmit() {
            if (!this.valid) {
                return;
            }
            this.resetButton = 'Sending...';
            let data = {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                password_confirmation: this.user.password_confirmation,
            };
            console.log(data);
            this.$emit('resetPassword', data);
        },

    },
}
</script>

<style scoped>

</style>
