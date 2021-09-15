<template>
    <div>
        <div v-if="isLoggedin">
            {{ user.name }}
        </div>
        <div v-else>
            <a href="" @click.prevent="toggleModal('login')">Login</a>

            <login :active="openLogin" @loginUser="loginUser" @toggleModal="toggleModal"></login>
        </div>
    </div>
</template>

<script>
import UserService from "../../services/UserService";
import Login from "../auth/Login";

export default {
    name: "AuthUserLink",
    components: {Login},
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
    computed: {
        isLoggedin: function () {
            return (this.user !== null);
        }
    },
    methods: {
        toggleModal(modal) {

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
        checkUser() {
            UserService.get().then((response) => {
                this.user = response.data;
            });
        },
        loginUser(data) {
            UserService.login(data).then((response) => {
                this.isLoggedin = response.data.success;
                this.checkUser();
            });
        }
    }
}
</script>

<style scoped>

</style>
