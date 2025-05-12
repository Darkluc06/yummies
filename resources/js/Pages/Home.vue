<template>
    <article class="yummies">
        <DesktopNavigation :title="data.title" />
        <header class="yummies_header">
            <div class="yummies_header-content">
                <h1 class="yummies_header-h1"> {{ data.title }} </h1>
                <label class="yummies_span">
                    <SvgIcon :name="`search`" />
                    <input v-model="searchTerm" @input="generateSuggestions" @keyup.enter="performSearch" type="text"
                        placeholder="Zoek recepten" class="yummies_input" ref="searchField"
                        id="yummies-input" />
                    <ul v-if="suggestions.length > 0" class="search-suggestions">
                        <li v-for="suggestion in suggestions" :key="suggestion.urlName"
                            @click="selectSuggestion(suggestion)" class="search-suggestion-item">
                            {{ suggestion.name }}
                        </li>
                    </ul>
                </label>
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
        <FooterComponent :class="{ hidden: !footerVisible }"></FooterComponent>
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
import DesktopNavigation from '@/Components/navigation/desktopNavigation.vue';

export default {
    components: {
        Navigation,
        NewRecipecomponent,
        Recipe,
        Legenda,
        FooterComponent,
        SvgIcon,
        DesktopNavigation
    },
    data() {
        return {
            data: json.home,
            legendaOpen: false,
            selectedCategory: null,
            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
            searchTerm: '',
            suggestions: [],   // De zoeksuggesties
        };
    },
    computed: {
        filteredRecipes() {
            const searchTermLower = this.searchTerm.toLowerCase();

            if (!searchTermLower && (!this.selectedCategory || this.selectedCategory === 'all')) {
                return this.data.recipes;
            }
            return this.data.recipes.filter(recipe => {
                const nameRecipe = recipe.name.toLowerCase().includes(searchTermLower);
                const nameType = recipe.type.toLowerCase().includes(searchTermLower);
                const description = recipe.description.toLowerCase().includes(searchTermLower);
                const ingredients = recipe.ingredients.some(ing => ing.name.toLowerCase().includes(searchTermLower));
                const keywords = recipe.keywords && recipe.keywords.some(keyword => keyword.toLowerCase().includes(searchTermLower));
                const category = !this.selectedCategory || this.selectedCategory === 'all' || recipe.type === this.selectedCategory;

                return category && (nameRecipe || nameType || description || ingredients || keywords);
            });
        }
    },
    mounted() {
        this.checkScrollability();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
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
        },
        // Checkt if the footer needs to be visible on the page
        checkScrollability() {
            this.isScrollable = document.body.scrollHeight > document.body.clientHeight;
            if (!this.isScrollable && !this.isScrolling) {
                this.footerVisible = true;
            } else {
                this.footerVisible = false;
            }
        },
        handleScroll() {
            this.footerVisible = false;
            this.isScrolling = true;
            clearTimeout(this.scrollTimeout);
            this.scrollTimeout = setTimeout(() => {
                this.isScrolling = false;
                this.checkScrollability();
            }, 100);
        },

        generateSuggestions() {
            const searchTermLower = this.searchTerm.toLowerCase();
            if (!searchTermLower) {
                this.suggestions = [];
                return;
            }

            this.suggestions = this.data.recipes
                .filter(recipe =>
                    recipe.name.toLowerCase().includes(searchTermLower) ||
                    recipe.type.toLowerCase().includes(searchTermLower) ||
                    recipe.description.toLowerCase().includes(searchTermLower) ||
                    recipe.ingredients.some(ing => ing.name.toLowerCase().includes(searchTermLower)) ||
                    (recipe.keywords && recipe.keywords.some(keyword => keyword.toLowerCase().includes(searchTermLower)))
                )
                .slice(0, 5); // Limit the suggestions to 5
        },

        performSearch() {
        // The filtering is already done in filteredRecipes,
        // here we only need to hide the suggestions.
            this.suggestions = [];
        },

        selectSuggestion(suggestion) {
            // Fill in the searchterm
            this.searchTerm = suggestion.name;
            // Hide the suggestions
            this.performSearch();
        },

        setSelectedCategory(category) {
            this.selectedCategory = category;
            this.searchTerm = '';
            this.suggestions = [];
        },
    }
};
</script>
