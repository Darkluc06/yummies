<template>
    <article class="yummies">
        <header class="yummies_header">
            <div class="yummies_header-content">
                <h1 class="yummies_header-h1"> {{ data.title }} </h1>
                <label class="yummies_span">
                    <SvgIcon :name="`search`" />
                    <input type="text" placeholder="Zoek verschillende kookstijlen" class="yummies_input"
                        ref="searchField" id="yummies-input" />
                </label>
                <!-- <h2 class="yummies_header-h2"> {{ data.headerH2 }} </h2> -->
            </div>
            <div class="yummies_navigation">
                <Navigation @categorySelected="setSelectedCategory" />
            </div>
        </header>
        <main class="yummies_main">
            <section class="yummies_new-recipes">

            </section>
            <section class="yummies_recipes">
                <h1 class="yummies_recipes-h1"> {{ data.sectionRecipeH2 }} </h1>
                <ul class="yummies_recipes-container">
                    <Recipe v-for="recipe in filteredRecipes" :key="recipe.name" :recipe="recipe" />
                </ul>
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
import json from './../../assets/json/data.json'
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';

export default {
    components: {
        Navigation,
        NewRecipecomponent,
        Recipe,
        Legenda,
        FooterComponent,
        SvgIcon
    },
    data() {
        return {
            data: json.home,
            legendaOpen: false,
            selectedCategory: null
        };
    },
    computed: {
        filteredRecipes() {
            if (!this.selectedCategory || this.selectedCategory === 'all') {
                return this.data.recipes;
            }
            return this.data.recipes.filter(recipe => recipe.type === this.selectedCategory);
        }
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
        setSelectedCategory(category) {
            this.selectedCategory = category;
        }
    }
};
</script>
