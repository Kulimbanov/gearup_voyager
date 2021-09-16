<template>
    <div class="user-modal-container" :class="{ 'active': active }" @click="close($event)" id="login-modal">
        <div class="user-modal">
            <div class="form-login" :class="{ 'active': active }" id="form-login">
                <div class="error-message" v-text="loginTittle"></div>
                <input type="text" name="user" placeholder="Email or Username" v-model="user.username"
                       @keyup.enter="loginSubmit" @blur="validateEmail">
                <input type="password" name="password" placeholder="Password" v-model="user.password"
                       @keyup.enter="loginSubmit">
                <input type="submit" :class="{ 'disabled': valid }" @click.prevent="loginSubmit"
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
        active: false
    },
    data() {
        return {
            user: {
                username: '',
                password: ''
            },
            loginButton: 'Login',
            loginTittle: 'Welcome',
        }
    },
    computed: {
        valid() {
            return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.username));
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
        validateEmail() {
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.username)) {
                this.loginTittle = 'Please enter a valid email address';
            } else {
                this.loginTittle = 'Email looks good';
                this.loginButton = 'Send';
            }
        },
        loginSubmit() {
            this.validateEmail();
            if (this.valid) {
                return;
            }
            this.loginButton = 'Logging in...';
            let data = {
                user: this.user.username,
                password: this.user.password
            };
            this.$emit('loginUser', data);
        }
    }

}
</script>

<style scoped>

</style>
