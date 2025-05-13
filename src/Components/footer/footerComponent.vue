<template>
    <section class="footer_component">
        <RouterLink :to="`/`" class="footer_link">
            <SvgIcon :name="'book'" />
            <p class="footer_p">
                Recepten
            </p>
        </RouterLink>
        <RouterLink :to="`/documentation`" class="footer_link">
            <SvgIcon :name="'document'" />
            <p class="footer_p">
                Documentatie
            </p>
        </RouterLink>
        <RouterLink :to="`/favorite`" class="footer_link">
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
    }
}

</script>
