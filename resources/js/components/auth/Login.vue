<template>
    <div class="user-modal-container" :class="{ 'active': active }" @click="close($event)" id="login-modal">
        <div class="user-modal">
            <div class="form-login" :class="{ 'active': active }" id="form-login">
                <div class="error-message" v-text="loginTittle"></div>
                <input type="text" name="user" placeholder="Email" v-model="user.email"
                       @keyup.enter="loginSubmit">
                <input type="password" name="password" placeholder="Password" v-model="user.password"
                       @keyup.enter="loginSubmit">
                <input type="submit" :class="{ 'disabled': !valid }" @click.prevent="loginSubmit"
                       v-model="this.loginButton" id="loginSubmit">
                <div class="links">
                    <a href="" @click.prevent="open()">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    props: {
        active: false,
        message: '',
    },
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            loginButton: 'Login',
        }
    },
    computed: {
        valid() {
            return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email));
        },
        loginTittle() {
            if (this.message !== '') {
                if (this.message === '0') {
                    this.loginButton = 'Try again';
                } else {
                    this.loginButton = this.message;
                }
                return 'Email or password is wrong';
            }
            if (this.valid) {
                this.loginButton = 'Send';
                return 'Email looks good';
            } else {
                if (this.user.email === '') {
                    this.loginButton = 'Login';
                    return 'Welcome';
                }
                this.loginButton = 'No!';
                return 'Please enter a valid email address';
            }
        }
    },
    methods: {
        close(e) {
            if (e.target.id === 'login-modal')
                this.$emit('toggleModal', 'login');
        },
        open() {
            this.$emit('toggleModal', 'login');
            this.$emit('toggleModal', 'password');
        },
        loginSubmit() {
            if (!this.valid) {
                return;
            }
            this.loginButton = 'Logging in...';
            let data = {
                email: this.user.email,
                password: this.user.password
            };
            this.$emit('loginUser', data);
        }
    }
}
</script>

<style scoped>

</style>
