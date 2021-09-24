<template>
    <div class="user-modal-container" :class="{ 'active': active }" @click="close($event)" id="password-modal">
        <div class="user-modal">
            <div class="form-password" :class="{ 'active': active }" id="form-password">
                <div class="error-message" v-text="passwordTittle"></div>
                <input type="email" name="email" placeholder="Email" v-model="user.email"
                       @keyup.enter="passwordSubmit" @blur="validateEmail">
                <input type="submit" :class="{ 'disabled': !valid }"
                       @click="passwordSubmit" v-model="passwordButton" id="passwordSubmit">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ForgotPassword",
    props: {
        active: false
    },
    data() {
        return {
            user: {
                email: '',
            },
            passwordButton: 'Get reset link',
            passwordTittle: 'Send restart password link',
        }
    },
    computed: {
        valid() {
            return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email));
        }
    },
    methods: {
        close(e) {
            if (e.target.id === 'password-modal')
                this.$emit('toggleModal', 'password');
        },
        validateEmail() {
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
                this.passwordTittle = 'Please enter a valid email address';
            } else {
                this.passwordTittle = 'Looks good';
                this.passwordButton = 'Get reset link';
            }
        },
        passwordSubmit() {
            this.validateEmail();
            if (!this.valid) {
                return;
            }
            this.passwordButton = "Sending...";
            this.$emit('forgotPassword', {email: this.user.email});
        }
    }
}
</script>

<style scoped>

</style>
