<template>
    <article class="recipePage">
        <imageComponent :figureClass="`recipePage__figure`" :imageClass="`recipePage__img`" :imageSource="recipe.image"
            :imageAlt="`test`" />
        <section class="recipePage__text">
            <figure class="recipe__type">
                <SvgIcon :name="`burger`" />
            </figure>
            <div class="recipePage__wrapper">
                <div>
                    <h1 class="recipePage__title">{{ this.recipe.name }}</h1>
                    <span class="recipePage__favorite">
                        <button id="safeRecipe-{{ recipe.id }}" class="recipe__span" @click="toggleFavorite">
                            <SvgIcon :name="heart" />
                        </button>
                    </span>
                </div>
                <Link :href="`/`">
                <SvgIcon :name="`close`" />
                </Link>
            </div>
            <p class="recipePage__p">
                {{ this.recipe["description"] }}
            </p>
            <ul class="recipePage__icons">
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`timer`" /> {{ this.recipe.time }}
                    </span>
                </li>
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`grocery`" /> {{ this.recipe.ingredients.length }}
                    </span>
                </li>
            </ul>
            <h2 class="recipePage__subTitle">
                Ingrediënten
            </h2>
            <div class="recipePage__wrapper">
                <h3> {{ this.recipe.servings }} porties </h3>
                <div>
                    <button class="recipePage__button" @click="removeServingToRecipe">
                        <SvgIcon :name="`minus`" />
                    </button>
                    <button class="recipePage__button" @click="addServingToRecipe">
                        <SvgIcon :name="`plus`" />
                    </button>
                </div>
            </div>
            <ul class="ingredients ingredients--list">
                <ingredients v-for="ingredient in this.recipe.ingredients" :key="ingredient.amount"
                    :ingredient="ingredient" />
            </ul>
            <div class="recipePage__wrapper" v-if="this.recipe.diagram">
                <h2 class="recipePage__subTitle">Kookdiagram</h2>
                <button @click="modalOpen" class="recipePage__modalButton">Legenda</button>
            </div>
            <div class="recipePage__wrapper" v-if="!this.recipe.diagram">
                <h2 class="recipePage__subTitle">Geen kookdiagram</h2>
            </div>
            <cookingDiagram :nameOfRecipe="this.recipe" :key="this.recipe" />
        </section>
        <modal :open="openModal" :recipe="this.recipe" @close="closeModal" />
    </article>
    <FooterComponent :class="{ hidden: !footerVisible }"></FooterComponent>
</template>

<script>

import imageComponent from '@/Components/general/image/imageComponent.vue';
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import iconComponent from '@/Components/general/icon/icon.vue';
import { Link } from '@inertiajs/vue3';
import ingredients from '@/Components/recipe/ingredients.vue';
import modal from '@/Components/modal/modal.vue';
import cookingDiagram from '@/Components/cookingDiagram/cookingDiagram.vue';
import json from './../../../assets/json/data.json';
import FooterComponent from "../../Components/footer/footer.vue"

export default {
    components: {
        imageComponent,
        SvgIcon,
        iconComponent,
        Link,
        ingredients,
        modal,
        cookingDiagram,
        FooterComponent
    },
    data() {
        return {
            openModal: false,
            recipe: null,
            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
            isFavorite: false,
            heart: "heart"
        }
    },
    created() {
        let urlParams = new URLSearchParams(window.location.search);
        this.recipe = json.home.recipes.find(recipe => recipe.urlName === urlParams.get('name'));
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
    watch: {
        recipe: {
            handler(newRecipe) {
                if (newRecipe && newRecipe.urlName) {
                    const favoriteKey = 'favoriteRecipes';
                    const storedFavorites = localStorage.getItem(favoriteKey);
                    this.isFavorite = storedFavorites ? JSON.parse(storedFavorites).includes(newRecipe.urlName) : false;
                    this.updateHeartColor();
                    console.log('Watch - recipe changed. isFavorite:', this.isFavorite, 'heart:', this.heart);
                }
            },
            immediate: true // Voer de handler uit bij de initiële creatie als recipe al beschikbaar is
        }
    },
    methods: {
        modalOpen() {
            this.openModal = true;
            this.updateRecipePageStyle();
        },
        closeModal() {
            this.openModal = false;
            this.updateRecipePageStyle();
        },
        updateRecipePageStyle() {
            let recipePage = document.querySelectorAll(".recipePage");
            if (recipePage && recipePage[0]) {
                if (this.openModal) {
                    recipePage[0].style.height = "100dvh";
                    recipePage[0].style.overflowY = "hidden";
                } else {
                    recipePage[0].style.height = "auto";
                    recipePage[0].style.overflowY = "scroll";
                }
            }
        },
        addServingToRecipe() {
            this.recipe.servings++;
            this.calculateIngredientAmounts(this.recipe.servings - 1, this.recipe.servings);
        },
        removeServingToRecipe() {
            if (this.recipe.servings <= 1) {
                this.recipe.servings = 1;
                return;
            }
            this.recipe.servings--;
            this.calculateIngredientAmounts(this.recipe.servings + 1, this.recipe.servings);
        },
        calculateIngredientAmounts(oldServings, newServings) {
            for (let index = 0; index < this.recipe.ingredients.length; index++) {
                const ingredient = this.recipe.ingredients[index];
                ingredient.amount = ingredient.amount / oldServings * newServings;
            }
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
        toggleFavorite() {
            this.isFavorite = !this.isFavorite;
            console.log('toggleFavorite: isFavorite na toggle', this.isFavorite);
            const favoriteKey = 'favoriteRecipes';
            let favorites = JSON.parse(localStorage.getItem(favoriteKey)) || [];

            if (this.isFavorite) {
                if (!favorites.includes(this.recipe.urlName)) {
                    favorites.push(this.recipe.urlName);
                    console.log('toggleFavorite: recept toegevoegd aan favorieten', this.recipe.urlName, favorites);
                }
            } else {
                favorites = favorites.filter(url => url !== this.recipe.urlName);
                console.log('toggleFavorite: recept verwijderd uit favorieten', this.recipe.urlName, favorites);
            }

            localStorage.setItem(favoriteKey, JSON.stringify(favorites));
            console.log('toggleFavorite: localStorage na update', localStorage.getItem(favoriteKey));
            this.updateHeartColor();
            console.log('toggleFavorite: heart na updateHeartColor', this.heart);
        },
        updateHeartColor() {
            this.heart = this.isFavorite ? "heart-fill" : "heart";
            console.log('updateHeartColor: heart is nu', this.heart, 'isFavorite is', this.isFavorite);
        }
    }
}
</script>
