<script>
import Navigation from '@/Components/navigation/navigation.vue';
import NewRecipecomponent from '@/Components/new-recipe/new-recipe.vue';
import "../../scss/style.scss"

export default {
    components: {
        Navigation,
        NewRecipecomponent
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
                <Navigation></Navigation>
            </div>
        </header>
        <main class="yummies_main">
            <section class="yummies_new-recipes">
                <NewRecipecomponent></NewRecipecomponent>
                <NewRecipecomponent></NewRecipecomponent>
                <NewRecipecomponent></NewRecipecomponent>
                <NewRecipecomponent></NewRecipecomponent>
            </section>
            <section class="yummies_recipes">
                <h2 class="yummies_recipes-name">Recepten</h2>
                <div class="yummies_recipes-container">

                </div>
            </section>
        </main>

    </article>



</template>


