<script>
import Navigation from '@/Components/navigation/navigation.vue';
import NewRecipecomponent from '@/Components/new-recipe/new-recipe.vue';
import Recipe from '@/Components/recipe/recipe.vue';

export default {
    components: {
        Navigation,
        NewRecipecomponent,
        Recipe
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
            <section class="yummies_legenda">
                <h1 class="yummies_legenda-h1">Legenda</h1>
                <p class="yummies_legenda-explanation">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam magnam tempore nemo laboriosam non est maxime, excepturi voluptate natus placeat officiis nobis amet, mollitia tenetur repellat. Voluptatem dolore ipsa neque!
                </p>
                <button class="yummies_legenda-button">
                    Zie legenda
                </button>
            </section>
            <section class="yummies_recipes">
                <h1 class="yummies_recipes-h1">Recepten</h1>
                <div class="yummies_recipes-container">
                    <Recipe></Recipe>
                    <Recipe></Recipe>
                </div>
            </section>
        </main>

    </article>



</template>


