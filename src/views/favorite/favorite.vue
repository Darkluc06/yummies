<template>
    <DesktopNavigation :title="'Kook Diagram'" />
    <article class="favorites">
        <main class="favorites_main">
            <header class="favorites_header">
                <h1 class="favorites_h1">Mijn Favoriete Recepten</h1>
            </header>
            <ul class="favorites_container">
                <Recipe
                    v-for="recipe in favoriteRecipes"
                    :key="recipe.urlName" :recipe="recipe"
                />
                <li class="favorite_li" v-if="favoriteRecipes.length === 0">
                    <p class="favorite_p">Je hebt nog geen recepten als favoriet gemarkeerd.</p>
                </li>
            </ul>
        </main>
    </article>

    <FooterComponent :class="{ hidden: !footerVisible }"></FooterComponent>
</template>

<script>
import FooterComponent from '../../Components/footer/footerComponent.vue';
import json from '../../assets/json/recipe.json';
import Recipe from './../../Components/recipe/recipe.vue';
import DesktopNavigation from '@/Components/navigation/desktopNavigation.vue';

export default {
    components: {
        FooterComponent,
        Recipe,
        DesktopNavigation
    },
    data() {
        return {
            recipe: json,
            favoriteRecipeUrls: [], 
            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
        };
    },
    mounted() {
        this.loadFavoriteRecipes();
        this.checkScrollability();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
    },
    computed: {
        favoriteRecipes() {
            return this.recipe.recipePage.recipes.filter(recipe => this.favoriteRecipeUrls.includes(recipe.urlName));
        }
    },
    methods: {
        loadFavoriteRecipes() {
            const storedFavorites = localStorage.getItem('favoriteRecipes');
            this.favoriteRecipeUrls = storedFavorites ? JSON.parse(storedFavorites) : [];
        },
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
    }
};
</script>


