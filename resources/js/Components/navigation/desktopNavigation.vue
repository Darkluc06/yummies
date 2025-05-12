<template>
     <nav class="desktopNav">
        <h1 class="desktopNav__title">
            {{ title }}
        </h1>
        <ul class="desktopNav__list">
            <li class="desktopNav__listItem">
                <Link :href="`/`" class="desktopNav__link">
                    Recepten
                </Link>
            </li>
             <li class="desktopNav__listItem">
                <Link :href="`/documentation`" class="desktopNav__link">
                    Documentatie
                </Link>
            </li>
             <li class="desktopNav__listItem">
                <Link :href="`/favorite`" class="desktopNav__link">
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