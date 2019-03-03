window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        baseHref: 'https://newsmeme.brodos.ro',
		isNewsAlert: false,
		isBreakingNews: false,
		isLive: true,
		city: 'Timișoara',
        title: 'Ministrul Culturii despre Mihai Eminescu',
        subtitle: 'D. Breaz: E cel mai mare poet al României, cel puțin până acum',
        subnews: 'Oamenii cer dublarea salariilor și condiții mai bune',
        time: '20:21',
        cover: '',
        generatedImage: false,
        downloadAction: null,
        triggerDownload: null,
        memeChanged: false,
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
        
        toggleSidebar() {
            let sidebar = document.querySelector('.sidebar');

            sidebar.classList.toggle('slideInRight');
            
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');    
            }

            let main = document.querySelector('.main');
            main.classList.toggle('xl:mr-128'); 

            let body = document.querySelector('body');
            body.classList.toggle('overflow-hidden');
        },
        hideSidebar() {
            let sidebar = document.querySelector('.sidebar');
            sidebar.classList.remove('slideInRight');

            let main = document.querySelector('.main');
            main.classList.remove('xl:mr-128'); 

            let body = document.querySelector('body');
            body.classList.remove('overflow-hidden');
        },
        updateCover() {
            this.$refs.cover.style.backgroundImage = 'url(' + this.cover + ')';
        },
        generateScreenshot() {
            let vm = this;
            let form = document.getElementById('news-form');
            let data = new FormData(form);
            let genericImage = document.querySelector('.generic-image');
            this.triggerDownload.classList.add('opacity-50');

            axios.post('/compose', data).then(function(response) {
                    if (response.data.success === true) {
                        // set the image
                        genericImage.src = response.data.image_url;

                        // let Vue know about the new image
                        vm.generatedImage = response.data.image_url;

                        // set the download button href
                        vm.downloadAction.href = vm.baseHref + '/download/?f=' + response.data.image_url;

                        vm.downloadAction.click();

                        vm.triggerDownload.classList.remove('opacity-50');

                        // hide the sidebar
                        vm.hideSidebar();
                        
                    } else {
                        alert('Eroare');
                    }
                    
                }).catch(function(e) {
                    alert(e);
                });  
        }
    },
    mounted() {
        let vm = this;
        this.cover = this.$refs.cover.dataset.url;
        this.downloadAction = document.querySelector('.download-newsmeme');
        this.triggerDownload = document.querySelector('.trigger-download');

        document.addEventListener('keydown', function(e) {
            if (e.keyCode == 27) {
                vm.hideSidebar();
            }
        });
    },
    watch: {
        title() {
            this.memeChanged = true;
        },
        subtitle() {
            this.memeChanged = true;  
        },
        subnews() {
            this.memeChanged = true;
        },
        isLive() {
            this.memeChanged = true;
        },
        isNewsAlert() {
            this.memeChanged = true;
        },
        isBreakingNews() {
            this.memeChanged = true;
        },
        time() {
            this.memeChanged = true;
        },
        city() {
            this.memeChanged = true;
        }
    }
});