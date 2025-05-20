<template>
    <section class="footer_component">
        <figure class="arrow-container" v-if="this.renderArrow()">
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

import { RouterLink } from 'vue-router';
import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components:{
        RouterLink,
        SvgIcon
    },
    methods: {
        renderArrow() {
            return localStorage.getItem("arrow") !== "true";
        }
    }
}

</script>
