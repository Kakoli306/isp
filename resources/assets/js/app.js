
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

Vue.component('modal', {
    template: '#modal-template'
})

var app = new Vue({
    el: '#vue-wrapper',

    data: {
        items: [],
        hasError: true,
        hasDeleted: true,
        hasAgeError: true,
        showModal: false,
        e_name: '',
        e_age: '',
        e_id: '',
        e_profession: '',
        newItem: { 'head_name': '','head_details': '','status': '' },
    },
    mounted: function mounted() {
        this.getVueItems();
    },
    methods: {
        getVueItems: function getVueItems() {
            var _this = this;

            axios.get('/manage-vue').then(function (response) {
                _this.items = response.data;
            });
        },
        setVal(val_id, val_name, val_age, val_profession) {
            this.e_id = val_id;
            this.e_name = val_name;
            this.e_age = val_age;
            this.e_profession = val_profession;
        },

        createItem: function createItem() {
            var _this = this;
            var input = this.newItem;

            if (input['head_name'] == '' || input['head_details'] == '' || input['status'] == '' ) {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios.post('/manage-vue', input).then(function (response) {
                    _this.newItem = { 'head_name': '', 'head_name': '', 'status': '' };
                    _this.getVueItems();
                });
                this.hasDeleted = true;
            }
        },
        editItem: function(){
            var i_val_1 = document.getElementById('e_id');
            var n_val_1 = document.getElementById('e_head_name');
            var a_val_1 = document.getElementById('e_head_details');
            var p_val_1 = document.getElementById('e_status');

            axios.post('/edititems/' + i_val_1.value, {val_1: n_val_1.value, val_2: a_val_1.value,val_3: p_val_1.value })
                .then(response => {
                    this.getVueItems();
                    this.showModal=false
                });
            this.hasDeleted = true;

        },
        deleteItem: function deleteItem(item) {
            var _this = this;
            axios.post('/manage-vue' +
                '/' + item.id).then(function (response) {
                _this.getVueItems();
                _this.hasError = true,
                    _this.hasDeleted = false

            });
        }
    }
});

