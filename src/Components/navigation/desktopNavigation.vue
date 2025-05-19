<template>
    <nav class="desktopNav">
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
    </nav>
</template>

<script>

import { RouterLink } from 'vue-router';
import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    props: {
        title: String
    },
    components: {
        RouterLink,
        SvgIcon
    }
}

</script>