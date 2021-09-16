<template>
    <div>
        <div v-if="user">
            {{ user.name }}
            <a href="" @click.prevent="logout">Logout</a>
        </div>
        <div v-else>
            <a href="" @click.prevent="toggleModal('login')">Login</a>
            <login :active="openLogin" @loginUser="loginUser" @toggleModal="toggleModal"></login>
            <forgot-password :active="openPass" @forgotPassword="forgotPassword"
                             @toggleModal="toggleModal"></forgot-password>

            <a href="" @click.prevent="toggleModal('register')">Register</a>
            <register :active="openRegister" @registerUser="registerUser" @toggleModal="toggleModal"></register>
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
            user: null
        }
    },
    created() {
        this.checkUser();
    },
    methods: {
        toggleModal(modal) {
            console.log(modal);
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
            this.openLogin = this.openRegister = this.openPass = false;
        },
        checkUser() {
            UserService.get().then((response) => {
                this.user = response.data ?? null;
            });
        },
        loginUser(data) {
            UserService.login(data).then((response) => {
                this.closeAll();
                this.checkUser();
                response.data.message;
            });
        },
        logout() {
            UserService.logout().then((response) => {
                console.log(response);
                this.closeAll();
                this.user = null;
            });
        },
        forgotPassword(data) {
            UserService.forgotPassword(data).then((response) => {
                console.log(response);
                this.closeAll();
            });
        },
        registerUser(data) {
            UserService.register(data).then((response) => {
                console.log(response);
                this.closeAll();
            });
        }

    }
}
</script>

<style scoped>

</style>
