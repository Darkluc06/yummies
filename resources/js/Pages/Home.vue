<template>
    <article class="yummies">
        <header class="yummies_header">
            <div class="yummies_header-content">
                <h1 class="yummies_header-h1">Yummies</h1>
                <input
                    type="text"
                    placeholder="Zoek verschillende kookstijlen"
                    class="yummies_input"
                    ref="searchField"
                    id="yummies-input"
                />
                <h2 class="yummies_header-h2">Verschillende kookstijlen</h2>
            </div>
            <div class="yummies_navigation">
                <Navigation />
            </div>
        </header>
        <main class="yummies_main">
            <section class="yummies_new-recipes">

            </section>
            <!-- <section class="yummies_legenda">
                <h1 class="yummies_legenda-h1">Legenda</h1>
                <p class="yummies_legenda-explanation">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam magnam tempore nemo laboriosam non est maxime, excepturi voluptate natus placeat officiis nobis amet, mollitia tenetur repellat. Voluptatem dolore ipsa neque!
                </p>
                <button class="yummies_legenda-button" @click="openLegenda">
                    Zie legenda
                </button>

                <Legenda v-if="legendaOpen" @close="closeLegenda" />
            </section> -->
            <section class="yummies_recipes">
                <h1 class="yummies_recipes-h1">Recepten</h1>
                <div class="yummies_recipes-container">
                    <Recipe />
                    <Recipe />
                </div>
            </section>
        </main>
        <FooterComponent></FooterComponent>
    </article>
</template>

<script>
import Legenda from '@/Components/legenda/legenda.vue';
import Navigation from '@/Components/navigation/navigation.vue';
import NewRecipecomponent from '@/Components/new-recipe/new-recipe.vue';
import Recipe from '@/Components/recipe/recipe.vue';
import FooterComponent from './../Components/footer/footer.vue'

export default {
    components: {
        Navigation,
        NewRecipecomponent,
        Recipe,
        Legenda,
        FooterComponent
    },
    data() {
        return {
            legendaOpen: false
        };
    },
    methods: {
        openLegenda() {
            this.legendaOpen = true;
            let app = document.querySelectorAll(".yummies");
            app[0].style.height = "100dvh";
            app[0].style.overflowY = "hidden";

        },
        closeLegenda() {
            this.legendaOpen = false;
            let app = document.querySelectorAll(".yummies");
            app[0].style.height = "auto";
            app[0].style.overflowY = "scroll";
        },
    }
};
</script>
