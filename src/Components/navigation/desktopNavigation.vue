<template>
     <nav class="desktopNav">
        <RouterLink :to="`/`">
        <h1 class="desktopNav__title">
            {{ title }}
        </h1>
        </RouterLink>
        <ul class="desktopNav__list">
            <li class="desktopNav__listItem">
                <RouterLink :to="`/`" class="desktopNav__link">
                    Recepten
                </RouterLink>
            </li>
             <li class="desktopNav__listItem">
                <RouterLink :to="`/documentation`" class="desktopNav__link">
                    Documentatie
                </RouterLink>
            </li>
             <li class="desktopNav__listItem">
                <RouterLink :to="`/favorite`" class="desktopNav__link">
                    Favorieten
                </RouterLink>
            </li>
        </ul>
     </nav>
</template>

<script>

import { RouterLink } from 'vue-router';

export default {
    props:{
        title: String
    },
    components:{
        RouterLink
    }
}

</script>