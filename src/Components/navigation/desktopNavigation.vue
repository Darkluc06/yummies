<template>
    <nav class="desktopNav">
        <div>
            <RouterLink :to="`/`">
                <h1 class="desktopNav__title">
                    {{ title }}
                </h1>
            </RouterLink>
            <ul class="desktopNav__list">
                <li class="desktopNav__listItem">
                    <RouterLink :to="`/`" class="desktopNav__link" activeClass="desktopNav__link--active">
                        <SvgIcon :name="'book'" />
                        Recepten
                    </RouterLink>
                </li>
                <li class="desktopNav__listItem">
                    <figure class="arrow-container" v-if="this.renderArrow()">
                        <img class="arrow-container--img" src="/img/checkMe.webp" alt="">
                        <p class="arrow-container--p">Check me</p>
                    </figure>
                    <RouterLink :to="`/documentation`" class="desktopNav__link" activeClass="desktopNav__link--active">
                        <SvgIcon :name="'document'" />
                        Documentatie
                    </RouterLink>
                </li>
                <li class="desktopNav__listItem">
                    <RouterLink :to="`/favorite`" class="desktopNav__link" activeClass="desktopNav__link--active">
                        <SvgIcon :name="'heart'" />
                        Favorieten
                    </RouterLink>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>

import { RouterLink } from 'vue-router';
import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    props: {
        title: String,
    },
    components: {
        RouterLink,
        SvgIcon,
    },
    methods: {
        renderArrow() {
            return localStorage.getItem('arrow') !== 'true';
        },
    },
};

</script>
