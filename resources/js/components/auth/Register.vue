<template>
    <div class="user-modal-container" :class="{ 'active': active }" @click="close" id="register-modal">
        <div class="user-modal">

            <div class="form-register" :class="{ 'active': active }" id="form-register">
                <div class="error-message" v-text="registerTittle"></div>
                <input type="text" name="name" placeholder="Name" v-model="user.name"
                       @keyup.enter="register">
                <input type="email" name="email" placeholder="Email" v-model="user.email"
                       @keyup.enter="register">
                <input type="password" name="password" placeholder="Password" v-model="user.password"
                       @keyup.enter="register">
                <input type="password" name="confirm" placeholder="Confirm password" v-model="passwordConfirm"
                       @keyup.enter="register">
                <input type="submit" :class="{ 'disabled': valid }"
                       @click="register" v-model="registerButton" id="registerSubmit">
                <div class="links">
                    <a href="" @click.prevent="open">Already have an account?</a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    props: {
        active: false
    },
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
            },
            passwordConfirm: '',
            registerButton: 'Register',
            registerTittle: 'New user registration',
        }
    },
    computed: {
        valid() {
            return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) &&
                (this.user.password !== this.passwordConfirm) && (this.user.password !== '');
        }
    },
    methods: {
        close(e) {
            if (e.target.id === 'register-modal')
                this.$emit('toggleModal', 'register');
        },
        open() {
            this.$emit('toggleModal', 'register');
            this.$emit('toggleModal', 'login');
        },
        validateEmail() {
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
                this.registerTittle = 'Please enter a valid email address';
            } else {
                this.registerTittle = 'Looks good.';
                this.registerButton = 'Register';
            }
        },
        validatePasswords() {
            if (this.user.password !== this.passwordConfirm) {
                this.registerTittle = 'Confirm password does not match';
            } else {
                this.registerTittle = 'Looks good';
                this.registerButton = 'Register';
            }
        },
        validate() {
            this.validateEmail();
            this.validatePasswords();
        },
        register() {
            this.validate();
            if (!this.valid) {
                return;
            }
            this.registerButton = 'Sending...';
            let data = {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password
            };
            this.$emit('registerUser', data);
        }
    }
}
</script>

<style scoped>

</style>
