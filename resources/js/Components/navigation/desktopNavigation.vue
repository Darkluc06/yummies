<template>
     <nav class="desktopNav__container">
        <h1 class="desktopNav__title">
            {{ title }}
        </h1>
        <ul class="desktopNav__links">
            <li class="desktopNav__listItem">
                <Link :href="`/`" class="recipe__link">
                    Recepten
                </Link>
            </li>
             <li class="desktopNav__listItem">
                <Link :href="`/documentation`" class="recipe__link">
                    Documentatie
                </Link>
            </li>
             <li class="desktopNav__listItem">
                <Link :href="`/favorite`" class="recipe__link">
                    Favorieten
                </Link>
            </li>
        </ul>
     </nav>
</template>

<script>

import { Link } from '@inertiajs/vue3';

export default {
    props:{
        title: String
    },
    components:{
        Link
    }
}

</script>