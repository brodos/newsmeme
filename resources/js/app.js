
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



// let subtitle = document.querySelector('.subtitle');
// let subtitle_input = document.querySelector('.subtitle-input');

// let subnews = document.querySelector('.subnews');
// let subnews_input = document.querySelector('.subnews-input');

// title_input.classList.add('hidden');

// let titlePopper = new Popper(title, title_input, {
//     placement: 'top'
// });

const app = new Vue({
    el: '#app',
    data: {
		isNewsAlert: false,
		isBreakingNews: false,
		isLive: true,
		city: 'Cluj Napoca',
        title: 'Ministrul Culturii despre Mihai Eminescu',
        subtitle: 'D. Breaz: E cel mai mare poet al României, cel puțin până acum',
        subnews: 'Oamenii cer dublarea salariilor și condiții mai bune',
        time: '20:21',
        editModal: null,
	},
    computed: {
        hasCity() {
            return !! this.city;
        },
        hasSubnews() {
            return !! this.subnews;
        },
        hasTime() {
            return !! this.time;
        }
    },
    methods: { 
        showEditModal(section) {
            var element = this.editModal.querySelector(section);
            element.classList.remove('hidden');

            this.editModal.classList.add('flex');
            this.editModal.querySelector('input').focus();
            
        },
        hideEditModal() {
            this.editModal.classList.remove('flex');

            var elements = this.editModal.querySelectorAll('div');

            for (i = 0; i < elements.length; i++) {
                console.log(elements[i]);
                elements[i].classList.add('hidden');
            }
        }
    },
    mounted() {
        let vm = this;

        this.editModal = document.querySelector('.edit-modal');

        document.addEventListener('keydown', function(e) {
            if (e.keyCode == 27) {
                return vm.hideEditModal();
            }
        });
    }
});
