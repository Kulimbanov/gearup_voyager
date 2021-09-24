<template>
    <div class="user-modal-container" :class="{ 'active': active }" id="reset-modal">
        <div class="user-modal">
            <div class="form-login" :class="{ 'active': active }" id="form-reset">

                <div class="error-message" v-text="resetTittle"></div>

                <input type="email"
                       disabled
                       name="user"
                       placeholder="Email"
                       v-model="user.email"
                       @keyup.enter="resetSubmit">

                <input type="password"
                       name="password"
                       placeholder="Password"
                       v-model="user.password"
                       autocomplete="off"
                       @keyup.enter="resetSubmit">

                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirm password"
                       autocomplete="off"
                       v-model="user.password_confirmation"
                       @keyup.enter="resetSubmit">

                <input type="submit"
                       :class="{ 'disabled': !valid }"
                       @click.prevent="resetSubmit"
                       v-model="this.resetButton"
                       id="resetSubmit">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ResetPassword",
    props: {
        active: false,
        message: '',
        email: '',
    },
    data() {
        return {
            user: {
                email: '',
                password: '',
                password_confirmation: '',
            },
            resetButton: 'Reset',
            resendEmail: false,
            submitted: false
        }
    },
    created() {
        this.user.email = this.email;
    },
    computed: {
        valid() {
            return this.user.password.length >= 8 && this.user.password === this.user.password_confirmation;
        },
        resetTittle() {
            if (this.message !== '') {
                this.resendEmail = true;
                this.submitted = false;
                this.resetButton = 'Resend email';
                return this.message;
            }

            if (this.submitted) {
                this.resetButton = 'Sending...';
                return 'Just a moment';
            }

            if (this.user.password.length !== 0) {
                if (this.user.password.length < 8) {
                    return 'Password needs 8 or more characters';
                } else if (!this.valid) {
                    return 'Confirm password does not match';
                } else {
                    return 'Looks good';
                }
            }

            return 'Reset password';
        }
    },
    methods: {
        resetSubmit() {
            if (!this.valid || this.submitted) {
                return;
            }
            this.submitted = true;

            if (this.resendEmail) {
                this.$emit('forgotPassword', {email: this.user.email})
            } else {
                this.$emit('resetPassword', {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password,
                    password_confirmation: this.user.password_confirmation,
                })
            }
        },

    }
}
</script>

<style scoped>

</style>
