"use strict";var Header={compilerOptions:{delimiters:["${","}"]},data:function(){return{menuIsActive:!1}},methods:{toggleMenu:function(){this.menuIsActive=!this.menuIsActive},closeMenu:function(){this.menuIsActive&&(this.menuIsActive=!1)}}};Vue.createApp(Header).mount("#main_header");