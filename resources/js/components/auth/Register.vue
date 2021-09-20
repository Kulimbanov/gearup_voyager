<template>
    <div class="user-modal-container" :class="{ 'active': active }" @click="close" id="register-modal">
        <div class="user-modal">

            <div class="form-register" :class="{ 'active': active }" id="form-register">
                <div class="error-message" v-text="title"></div>
                <input type="text" name="name" placeholder="Name" v-model="user.name"
                       @keyup.enter="registerSubmit">
                <input type="email" name="email" placeholder="Email" v-model="user.email"
                       @keyup.enter="registerSubmit">
                <input type="password" name="password" placeholder="Password" v-model="user.password"
                       @keyup.enter="registerSubmit">
                <input type="password" name="c_password" placeholder="Confirm password" v-model="user.c_password"
                       @keyup.enter="registerSubmit">
                <input type="submit" :class="{ 'disabled': !valid }"
                       @click="registerSubmit" v-model="registerButton" id="registerSubmit">
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
        active: false,
        message: ''
    },
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                c_password: ''
            },
            passwordConfirm: '',
            registerButton: 'Register',
            registerTittle: 'New user registration',
        }
    },
    computed: {
        valid() {
            return this.validateEmail && this.validatePasswords;
        },
        validateEmail() {
            return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email);
        },
        validatePasswords() {
            return this.user.password !== '' && this.user.password === this.user.c_password;
        },
        title() {
            if (this.message === '0') {
                this.registerButton = 'Login';
                return this.message;
            }
            if (this.message === '1') {
                this.user = {
                    name: '',
                    email: '',
                    password: '',
                    c_password: '',
                }
                this.registerButton = 'Please verify';
            }
            if (this.message !== '') {
                this.registerButton = 'Login?';
                return this.message;
            }

            if (!this.validateEmail) {
                if (this.user.email === '') {
                    this.registerButton = 'Register';
                    return 'Register new user';
                }
                return 'Please enter a valid email address';
            } else {
                if (this.user.password.length < 8) {
                    return 'Password needs 8 or more characters';
                } else if (!this.validatePasswords) {
                    return 'Confirm password does not match';
                }
            }
            this.registerButton = 'Register';
            return 'Looks good';
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
        registerSubmit() {
            if (!this.valid) {
                return;
            }
            this.registerButton = 'Sending...';
            let data = {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                c_password: this.user.c_password,
            };
            this.$emit('registerUser', data);
        }
    }
}
</script>

<style scoped>

</style>
