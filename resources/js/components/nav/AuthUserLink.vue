<template>
    <div>
        <div v-if="user">
            {{ user.name }}
            <a href="" @click.prevent="logout">Logout</a>
        </div>
        <div v-else>
            <a href="" @click.prevent="toggleModal('login')">Login</a>
            <login :active="openLogin" @loginUser="loginUser" @toggleModal="toggleModal" :message="message"></login>
            <forgot-password :active="openPass" @forgotPassword="forgotPassword"
                             @toggleModal="toggleModal"></forgot-password>

            <a href="" @click.prevent="toggleModal('register')">Register</a>
            <register :active="openRegister" @registerUser="registerUser" @toggleModal="toggleModal"
                      :message="message"></register>
        </div>
    </div>
</template>

<script>
import UserService from "../../services/UserService";

import Login from "../auth/Login";
import ForgotPassword from "../auth/ForgotPassword";
import Register from "../auth/Register";

export default {
    name: "AuthUserLink",
    components: {
        Login,
        Register,
        ForgotPassword
    },
    data() {
        return {
            openLogin: false,
            openPass: false,
            openRegister: false,
            user: null,
            message: ''
        }
    },
    created() {
        this.checkUser();
    },
    methods: {
        toggleModal(modal) {
            this.message = '';
            switch (modal) {
                case 'login': {
                    this.openLogin = !this.openLogin;
                    break;
                }
                case 'password': {
                    this.openPass = !this.openPass;
                    break;
                }
                case 'register': {
                    this.openRegister = !this.openRegister;
                    break;
                }
            }
        },
        closeAll() {
            this.message = '';
            this.openLogin = this.openRegister = this.openPass = false;
        },
        checkUser() {
            UserService.get().then((response) => {
                this.user = response.data ?? null;
            }).catch(error => {
                let self = this;
                if (error.response.data.hasOwnProperty('errors')) {
                    error.response.data.errors.forEach(e => {
                        self.message += e;
                    });
                }
            })
        },
        loginUser(data) {
            this.message = '';
            UserService.login(data).then((response) => {
                this.message = response.data.message;
                setTimeout(() => {
                    if (response.data.success) {
                        this.closeAll();
                        this.checkUser();
                    } else {
                        this.message = '0';
                    }
                }, 2000);

            });
        },
        logout() {
            UserService.logout().then((response) => {
                this.user = null;
                this.message = "";
                this.closeAll();
                document.location.href = "/home";
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
                        this.message = 'Somthing is wrong';
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
