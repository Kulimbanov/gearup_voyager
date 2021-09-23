<template>
    <div class="flex">
        <div v-if="user">
            {{ user.name }}
            <a href="" @click.prevent="logout">Logout</a>
        </div>
        <div v-else>
            <a href="" @click.prevent="toggleModal('login')">Login</a>
            <login :active="openLogin" @loginUser="loginUser" @toggleModal="toggleModal" :message="message"></login>
            <forgot-password :active="openForgotPassword" @forgotPassword="forgotPassword"
                             @toggleModal="toggleModal"></forgot-password>

            <a href="" @click.prevent="toggleModal('register')">Register</a>
            <register :active="openRegister" @registerUser="registerUser" @toggleModal="toggleModal"
                      :message="message"></register>
        </div>
        <div v-if="token">
            <reset-password :active="openResetPassword"
                            :email="email"
                            :message="message"
                            @resetPassword="resetPassword"
                            @toggleModal="toggleModal"
            ></reset-password>
        </div>

        <div v-if="message" class="position-absolute top">
            <b-alert class="m-1" variant="dark" show dismissible fade>
                <font-awesome-icon class="text-white" v-if="message" icon="envelope" size="2x"
                                   @click.prevent="toggleModal('message')"
                />
                {{ info }}
            </b-alert>
        </div>
    </div>
</template>

<script>
import UserService from "../../services/UserService";
import {BAlert} from 'bootstrap-vue'
import Login from "../auth/Login";
import ForgotPassword from "../auth/ForgotPassword";
import Register from "../auth/Register";
import ResetPassword from "../auth/ResetPassword";

export default {
    name: "AuthUserLink",
    props: {
        user: null,
        token: null,
        email: null,
    },
    components: {
        BAlert,
        Login,
        Register,
        ForgotPassword,
        ResetPassword
    },
    data() {
        return {
            openMessage: false,
            openLogin: false,
            openRegister: false,
            openForgotPassword: false,
            openResetPassword: false,

            message: ''
        }
    },
    created() {
        if (this.token) {
            this.message = 'Reset Password';
            this.openResetPassword = true;
        }

        this.checkUser();
    },
    computed: {
        info() {
            if (this.message === 'Unauthenticated.') {
                this.message = null;
            }
            return this.message;
        }
    },
    methods: {
        toggleModal(modal) {
            switch (modal) {
                case 'message': {
                    this.openMessage = !this.openMessage;
                    break;
                }
                case 'login': {
                    this.message = 'Login';
                    this.openLogin = !this.openLogin;
                    break;
                }
                case 'password': {
                    this.message = 'Forgot password';
                    this.openForgotPassword = !this.openForgotPassword;
                    break;
                }
                case 'register': {
                    this.message = 'Register';
                    this.openRegister = !this.openRegister;
                    break;
                }
                case 'resetPassword': {
                    this.message = 'Reset password';
                    this.openResetPassword = !this.openResetPassword;
                    break;
                }
            }
        },
        closeAll() {
            this.message = '';
            this.openForgotPassword = this.openLogin = this.openRegister = this.openResetPassword = false;
        },
        checkUser() {
            UserService.get().then((response) => {
                this.user = response.data ?? null;
            }).catch(exception => {
                console.log(exception.response);
                if (exception.response.data.hasOwnProperty('errors')) {
                    exception.response.data.errors.forEach(e => {
                        this.message += e;
                    });
                }
                if (exception.response.data.hasOwnProperty('message')) {
                    this.message = exception.response.data.message;
                }
            })
        },
        loginUser(data) {
            this.message = '';
            UserService.login(data).then((response) => {
                this.message = response.data.message;
                setTimeout(() => {
                    if (response.status === 200) {
                        this.closeAll();
                        this.checkUser();
                    } else {
                        this.message = '0';
                    }
                }, 2000);

            });
        },
        resetPassword(data) {
            this.message = '';
            data.token = this.token;
            UserService.resetPassword(data, this.token).then((response) => {
                this.message = response.data.message;
                setTimeout(() => {
                    if (response.data.success) {
                        this.closeAll();
                        this.checkUser();
                    } else {
                        this.message = '0';
                    }
                }, 3000);
            }).catch(exception => {
                this.message = '0';

                if (exception.response) {
                    this.message = exception.response.data.message;
                    let errors = Object.keys(exception.response.data.errors)
                        .map(function (key) {
                            return exception.response.data.errors[key]
                        });
                    for (let field in errors) {
                        this.message += '/n' + errors[field][0];
                    }
                }
            })
        },
        logout() {
            UserService.logout().then((response) => {
                this.user = null;
                this.message = "";
                this.closeAll();
                document.location.href = "/";
            });
        },
        forgotPassword(data) {
            UserService.forgotPassword(data).then((response) => {
                console.log(response);
                this.closeAll();
            });
        },
        registerUser(data) {
            this.message = '';
            UserService.register(data).then((response) => {
                this.message = response.data.message;
                setTimeout(() => {
                    if (response.data.success || response.status === 201) {
                        this.message = '1';
                        this.closeAll();
                    } else {
                        this.message = 'Something is wrong';
                    }
                }, 2000);
            }).catch(exception => {
                this.message = '0';

                if (exception.response) {
                    this.message = exception.response.data.message;
                    let errors = Object.keys(exception.response.data.errors)
                        .map(function (key) {
                            return exception.response.data.errors[key]
                        });
                    for (let field in errors) {
                        this.message += '/n' + errors[field][0];
                    }
                }
            })
        }

    }
}
</script>

<style scoped>

</style>
