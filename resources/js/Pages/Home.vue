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
            <div class="yummies_navigation">
                <navigation></navigation>
            </div>
        </header>
        <main class="yummies_main">
            <section class="new-recipes">

            </section>
            <section class="yummies_recipes">
                
            </section>
        </main>

    </article>



</template>


