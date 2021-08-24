<template>
    <div class="col-md-6 col-sm-12 card py-5 px-3">
        <h3>Drop a Line</h3>
        <p>You can schedule your service or ask for recommendation or expertise</p>
        <form action="#" @submit.prevent="sendContactMessage">
            <div class="row mt-1">
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <input v-model="contact.name" type="text" name="name" class="form-control"
                           :class="!isNameValid?'is-invalid':''" placeholder="Your name">
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <input v-model="contact.phone" type="text" name="phone" class="form-control"
                           :class="!isPhoneValid?'is-invalid':''" placeholder="Phone">
                </div>
            </div>
            <div class="form-group col-12 mb-5">
                <input v-model="contact.email" type="text" name="email" class="form-control"
                       :class="!isEmailValid?'is-invalid':''" placeholder="e-mail">
            </div>
            <div class="form-group col-12 mb-2">
                <input v-model="contact.subject" type="text" name="subject" class="form-control"
                       :class="!isSubjectValid?'is-invalid':''" placeholder="Subject">
            </div>
            <div class="form-group col-12 mb-3">
                <textarea v-model="contact.message" rows="3" name="message" class="form-control"
                          :class="!isMessageValid?'is-invalid':''" placeholder="Message"/>
            </div>
            <div class="form-group m-auto d-flex justify-content-center">
                <button type="submit" class="btn btn-dark" v-bind:class="{'disabled':(!valid)}">
                    <font-awesome-icon v-if="sending" icon="spinner" size="2x" spin/>
                    <font-awesome-icon v-else-if="!sending" icon="paper-plane" size="2x"/>
                </button>
            </div>

            <div v-if="response!==''" class="alert alert-success d-flex align-items-center mt-5 fade show" role="alert">
                <div> {{ response }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </form>
    </div>
</template>

<script>
import {faPaperPlane, faSpinner} from '@fortawesome/free-solid-svg-icons'
import {library} from "@fortawesome/fontawesome-svg-core";

library.add(faPaperPlane)
library.add(faSpinner)

export default {
    name: "Contact",
    data() {
        return {
            validClass: 'active',
            errorClass: 'text-danger',
            sending: false,
            response: '',
            validators: {
                name: /^[\w\W]+(\s[\w\W]+)?$/i,
                email: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
                phone: /((00)?\+?[389]{3})?[\/\-\s*\.]?(((\(0\))|0)?\s*7\d{1})[\/\-\s*\.\,]?([\d]{3})[\/\-\s*\.\,]?([\d]{3})/,
                subject: /^[\w\W].{3,50}$/i,
                message: /^[\w\W].{3,255}$/i,
            },
            contact: {
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: '',
            },
            firstGo: {
                name: true,
                email: true,
                phone: true,
                subject: true,
                message: true,
            }
        }
    },
    methods: {
        sendContactMessage: function () {
            if (!this.valid) {
                return
            }
            this.sending = !this.sending;
            let self = this;
            let params = Object.assign({}, self.contact);
            this.$http.post(process.env.MIX_APP_API + '/api/contact', params)
                .then(function (res) {
                    self.response = res.data.response;
                    this.newContactData();
                }).catch(function (error) {
                if (error.response) {
                    self.response = "Ops...";
                }
            }).finally(() => self.sending = !self.sending)
        },
        newContactData: function () {
            this.$nextTick(function () {
                this.contact.name = '';
                this.contact.email = '';
                this.contact.phone = '';
                this.contact.subject = '';
                this.contact.message = '';
            });
        },
        setIsNotTheFirstGo: function (property) {
            this.firstGo[property] = false
            return (this.validators[property].test(this.contact[property]))
        }
    },
    computed: {
        valid: function () {
            return this.isNameValid &&
                this.isPhoneValid &&
                this.isEmailValid &&
                this.isSubjectValid &&
                this.isMessageValid &&
                !this.firstGo.name &&
                !this.firstGo.phone &&
                !this.firstGo.email &&
                !this.firstGo.subject &&
                !this.firstGo.message;
        },
        isNameValid: function () {
            return (this.contact.name === '') ? this.firstGo.name : this.setIsNotTheFirstGo('name');
        },
        isPhoneValid: function () {
            return (this.contact.phone === '') ? this.firstGo.phone : this.setIsNotTheFirstGo('phone');
        },
        isEmailValid: function () {
            return (this.contact.email === '') ? this.firstGo.email : this.setIsNotTheFirstGo('email');
        },
        isSubjectValid: function () {
            return (this.contact.subject === '') ? this.firstGo.subject : this.setIsNotTheFirstGo('subject');
        },
        isMessageValid: function () {
            return (this.contact.message === '') ? this.firstGo.message : this.setIsNotTheFirstGo('message');
        },
    }
}
</script>

<style scoped>

</style>
