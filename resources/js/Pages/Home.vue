<script>
import Navigation from '@/Components/navigation/navigation.vue';
import "../../scss/style.scss"

export default {
    components: {
        Navigation
    }
};
</script>

<template>

    <article class="yummies">
        <header class="yummies_header">
            <div class="yummies_header-content">
                <h1 class="yummies_header-h1">Yummies</h1>
                <h2 class="yummies_header-h2">Verschillende kookstijlen</h2>
            </div>
            <navigation></navigation>
        </header>

    </article>



</template>


