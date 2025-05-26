<template>
    <section class="footer_component">
        <figure class="arrow-container" :class="{ 'hidden-arrow': !showArrow }">
            <p class="arrow-container-p">Check me</p>
            <img class="arrow" src="/img/checkMe.webp" alt="">
        </figure>            
        <RouterLink :to="`/`" class="footer_link" activeClass="footer_link--active">
            <SvgIcon :name="'book'" />
            <p class="footer_p">
                Recepten
            </p>
        </RouterLink>
        <RouterLink :to="`/documentation`" class="footer_link" activeClass="footer_link--active">
            <SvgIcon :name="'document'" />
            <p class="footer_p">
                Documentatie
            </p>
        </RouterLink>
        <RouterLink :to="`/favorite`" class="footer_link" activeClass="footer_link--active">
            <SvgIcon :name="'heart'" />
            <p class="footer_p">
                Favorieten
            </p>
        </RouterLink>
    </section>
</template>

<script>
import { RouterLink, useRoute } from 'vue-router'; 
import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components:{
        RouterLink,
        SvgIcon
    },
    data() {
        return {
            isArrowHidden: localStorage.getItem("arrow") === "true",
        };
    },
    setup() {
        const route = useRoute(); 
        return { route }; 
    },
    computed: {
        showArrow() {
            return !this.isArrowHidden && this.route.path !== '/documentation';
        }
    },
    // Watch the route change to update localStorage
    watch: {
        '$route'(to) {
            if (to.path === '/documentation') {
                localStorage.setItem("arrow", "true"); 
                this.isArrowHidden = true; 
            } else {
                this.isArrowHidden = localStorage.getItem("arrow") === "true";
            }
        }
    },
    mounted() {
        this.isArrowHidden = localStorage.getItem("arrow") === "true";
        window.addEventListener('storage', this.handleStorageChange);
    },
    beforeUnmount() {
        window.removeEventListener('storage', this.handleStorageChange);
    },
    methods: {
        handleStorageChange(event) {
            if (event.key === 'arrow') {
                this.isArrowHidden = event.newValue === 'true';
            }
        }
    }
}
</script>
