const Header = {
    compilerOptions: {
        delimiters: ['${', '}']
    },
    data() {
        return {
            menuIsActive: false
        };
    },
    methods: {
        toggleMenu() {
            this.menuIsActive = !this.menuIsActive;
        },
        closeMenu() {
            if (this.menuIsActive) {
                this.menuIsActive = false;
            }
        }
    }
};

Vue.createApp(Header).mount('#main_header');
