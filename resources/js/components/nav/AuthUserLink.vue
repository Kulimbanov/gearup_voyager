<template>
    <div id="auth-link" class="flex">
        <div v-if="auth">
            {{ auth.name }}
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
                            @forgotPassword="forgotPassword"
                            @toggleModal="toggleModal"
            ></reset-password>
        </div>

        <div v-if="showAuthMessage" class="position-absolute top auth-message">
            <b-alert class="m-1" variant="dark" show dismissible fade>
                <font-awesome-icon
                    class="text-white"
                    v-if="message"
                    icon="envelope"
                    size="2x"
                    @click.prevent="toggleModal('message')"/>
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

            message: '',
            forceAuthMessage: false,
            authUser: null,
        }
    },
    created() {
        if (this.token) {
            this.openResetPassword = true;
        } else {
            this.checkUser();
        }
    },
    computed: {
        info() {
            console.log(this.message);
            if (this.message === 'Unauthenticated.') {
                this.message = '';
                return;
            }
            return this.message;
        },
        auth() {
            return this.user ?? this.authUser;
        },
        showAuthMessage() {
            return this.forceAuthMessage && !(
                this.openMessage ||
                this.openLogin ||
                this.openRegister ||
                this.openForgotPassword ||
                this.openResetPassword
            );
        }
    },
    methods: {
        toggleModal(modal) {
            this.setAuthMessage();
            switch (modal) {
                case 'message': {
                    this.openMessage = !this.openMessage;
                    break;
                }
                case 'login': {
                    this.openLogin = !this.openLogin;
                    break;
                }
                case 'password': {
                    this.openForgotPassword = !this.openForgotPassword;
                    break;
                }
                case 'register': {
                    this.openRegister = !this.openRegister;
                    break;
                }
                case 'resetPassword': {
                    this.openResetPassword = !this.openResetPassword;
                    break;
                }
            }
        },
        closeAll(message = '') {
            this.setAuthMessage(message);
            this.openForgotPassword = this.openLogin = this.openRegister = this.openResetPassword = false;
        },
        setAuthMessage(message = '') {
            // if (message !== '') {
            //     this.showAuthMessage = true;
            // }
            this.message = message;
        },
        processExceptionToErrorMessage(exception) {
            if (exception.response) {
                if (exception.response.data.hasOwnProperty('errors')) {
                    let errors = Object.keys(exception.response.data.errors)
                        .map((key) => exception.response.data.errors[key]).join('\n')
                    this.setAuthMessage(errors)
                } else if (exception.response.data.hasOwnProperty('message')) {
                    this.setAuthMessage(exception.response.data.message)
                }
            }
        },

        checkUser() {
            UserService.get().then((response) => {
                this.authUser = response.data ?? null;
                console.log(response);
            }).catch(exception => {
                this.processExceptionToErrorMessage(exception);
            })
        },
        loginUser(data) {
            UserService.login(data).then((response) => {
                console.log(response);
                this.closeAll('Success');
                setTimeout(() => {
                    this.checkUser();
                }, 2000);
            }).catch(exception => {
                this.processExceptionToErrorMessage(exception);
            })
        },
        logout() {
            UserService.logout().then((response) => {
                console.log(response);
                this.authUser = null;
                this.message = "";
                this.closeAll();
                document.location.href = "/";
            });
        },
        forgotPassword(data) {
            UserService.forgotPassword(data).then((response) => {
                this.closeAll(response.data.message);
            });
        },
        registerUser(data) {
            UserService.register(data).then((response) => {
                this.closeAll('Please verify your account.');
                setTimeout(() => {
                    if (response.data.success || response.status === 201) {
                        this.closeAll();
                    }
                }, 2000);
            }).catch(exception => {
                this.processExceptionToErrorMessage(exception);
            })
        },
        resetPassword(data) {
            data.token = this.token;
            UserService.resetPassword(data, this.token).then((response) => {
                setTimeout(() => {
                    if (response.data.success) {
                        this.closeAll('Success');
                        this.checkUser();
                    }
                }, 3000);
            }).catch(exception => {
                this.processExceptionToErrorMessage(exception);
            })
        },
    }
}
</script>
