<template>
    <div class="search my-1 m-auto mr-sm-0 my-sm-5 py-2">
        <form class="search-form" @submit="onFormSubmit($event)"
              :class="{ 'open': isSearchOpen, 'in': isSearchIn, 'close': isSearchClose , 'explode': shouldExplode }">
            <input class="input" @focus="onSearchFocusIn" type="text"/>
            <div @click="onAfterClicked($event)" class="after"></div>
            <input class="submit" @focus="onSearchFocusIn" type="submit"/>
        </form>
        <h4 v-if="haveMessage"></h4>
    </div>
</template>

<script>

const axios = require('axios');

export default {
    name: "Search",
    data() {
        return {
            isSearchOpen: false,
            isSearchIn: false,
            isSearchClose: false,
            shouldExplode: false,
            haveMessage: false,
        }
    },
    methods: {
        onSearchFocusIn: function () {
            if (this.isSearchOpen) return;
            this.isSearchIn = true;
            self = this;
            setTimeout(function () {
                self.isSearchOpen = true;
                self.isSearchIn = false;
            }, 300);
        },
        onAfterClicked: function (e) {
            e.preventDefault();
            if (!this.isSearchOpen) return;
            this.isSearchClose = true;
            this.isSearchOpen = false;
            self = this;
            setTimeout(function () {
                self.isSearchClose = false;
            }, 300);

        },
        onFormSubmit: function (e) {
            e.preventDefault();
            this.shouldExplode = true;
            self = this;
            setTimeout(function () {
                self.haveMessage = false;
                self.shouldExplode = false;
            }, 3000);
        },
    },
}
// var s = $('input'),
//     f = $('form'),
//     a = $('.after'),
//     m = $('h4');
// s.focus(function () {
//     if (f.hasClass('open')) return;
//     f.addClass('in');
//     setTimeout(function () {
//         f.addClass('open');
//         f.removeClass('in');
//     }, 1300);
// });
//
// a.on('click', function (e) {
//     e.preventDefault();
//     if (!f.hasClass('open')) return;
//     s.val('');
//     f.addClass('close');
//     f.removeClass('open');
//     setTimeout(function () {
//         f.removeClass('close');
//     }, 1300);
// })
//
// f.submit(function (e) {
//     e.preventDefault();
//     m.html('Thanks, high five!').addClass('show');
//     f.addClass('explode');
//     setTimeout(function () {
//         s.val('');
//         f.removeClass('explode');
//         m.removeClass('show');
//     }, 3000);
// })
</script>

<style scoped>
</style>
