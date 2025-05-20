<template>
    <DesktopNavigation :title="'Kook Diagram'" />
    <article class="recipePage" v-if="recipe">
        <div class="recipePage__container">
            <imageComponent :figureClass="`recipePage__figure`" :imageClass="`recipePage__img`"
                :imageSource="recipe.image" :imageAlt="recipe.name" />
            <section class="recipePage__text">
                <figure class="recipe__type">
                    <IconComponent :icon="recipe.type" />
                </figure>
                <div class="recipePage__wrapper recipePage__wrapper--header">
                    <div>
                        <h1 class="recipePage__title">{{ recipe.name }}</h1>
                        <span class="recipePage__favorite">
                            <button :id="`safeRecipe-${recipe.id}`" class="recipe__span" @click="toggleFavorite">
                                <SvgIcon :name="heart" />
                            </button>
                        </span>
                    </div>
                    <RouterLink :to="{ name: 'home' }">
                        <SvgIcon :name="`close`" :class-name="'recipePage__close'" />
                    </RouterLink>
                </div>
                <p class="recipePage__p">
                    {{ recipe.description }}
                </p>
                <ul class="recipePage__icons">
                    <li class="recipePage__icon">
                        <span>
                            <SvgIcon :name="`timer`" /> {{ recipe.time }}
                        </span>
                    </li>
                    <li class="recipePage__icon">
                        <span>
                            <SvgIcon :name="`grocery`" /> {{ recipe.ingredients.length }}
                        </span>
                    </li>
                </ul>
                <h2 class="recipePage__subTitle">
                    Ingrediënten
                </h2>
                <div class="recipePage__wrapper">
                    <h3> {{ recipe.servings }} porties </h3>
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
                    <ingredients v-for="(ingredient, index) in recipe.ingredients" :key="index"
                        :ingredient="ingredient" />
                </ul>
                <div class="recipePage__wrapper" v-if="recipe.diagram">
                    <h2 class="recipePage__subTitle">Kookdiagram</h2>
                    <button @click="modalOpen" class="recipePage__modalButton">Legenda</button>
                </div>
                <div class="recipePage__wrapper" v-if="!recipe.diagram">
                    <h2 class="recipePage__subTitle">Geen kookdiagram</h2>
                </div>
                <cookingDiagram :nameOfRecipe="recipe"
                    :key="`diagram-${JSON.stringify(recipe ? recipe.ingredients : [])}`" v-if="recipe.diagram" />
            </section>
            <modal :open="openModal" :recipe="recipe" @close="closeModal" />
        </div>
    </article>
    <div v-else class="recipePage__loading">
        <p>Recept aan het laden...</p>
    </div>
    <FooterComponent :class="{ hidden: !footerVisible }"></FooterComponent>
</template>

<script>
import imageComponent from '@/Components/general/image/imageComponent.vue';
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { RouterLink } from 'vue-router';
import ingredients from '@/Components/recipe/ingredients.vue';
import modal from '@/Components/modal/modal.vue';
import cookingDiagram from '@/Components/cookingDiagram/cookingDiagram.vue';
import json from '../../assets/json/recipe.json';
import FooterComponent from "../../Components/footer/footerComponent.vue";
import DesktopNavigation from '@/Components/navigation/desktopNavigation.vue';
import IconComponent from '@/Components/general/icon/icon.vue'

export default {
    name: "DetailPage",
    components: {
        imageComponent,
        SvgIcon,
        RouterLink,
        ingredients,
        modal,
        cookingDiagram,
        FooterComponent,
        DesktopNavigation,
        IconComponent
    },
    props: {
        urlName: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            openModal: false,
            recipe: null,
            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
            scrollTimeout: null,
            isFavorite: false,
            heart: "heart"
        }
    },
    created() {
        this.loadRecipeData();
    },
    mounted() {
        this.checkScrollability();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
        if (this.scrollTimeout) {
            clearTimeout(this.scrollTimeout);
        }
    },
    // Looks for changes
    watch: {
        urlName(newUrlName, oldUrlName) {
            if (newUrlName && newUrlName !== oldUrlName) {
                this.loadRecipeData();
            }
        },
        recipe(newRecipe) {
            if (newRecipe && newRecipe.urlName) {
                this.updateFavoriteStatus();
            }
        }
    },
    methods: {
        loadRecipeData() {
            console.log('DetailPage loading data for urlName prop:', this.urlName);
            if (json && json.recipePage && json.recipePage.recipes) {
                this.recipe = json.recipePage.recipes.find(r => r.urlName === this.urlName);
                if (this.recipe) {
                    console.log('DetailPage - found recipe:', this.recipe);
                } else {
                    console.error('Recipe not found for urlName:', this.urlName);
                }
            } else {
                console.error('Error: Could not access json.recipePage.recipes or JSON data is not in the expected format.');
                this.recipe = null;
            }
        },
        updateFavoriteStatus() {
            if (!this.recipe || !this.recipe.urlName) return;
            const favoriteKey = 'favoriteRecipes';
            const storedFavorites = localStorage.getItem(favoriteKey);
            this.isFavorite = storedFavorites ? JSON.parse(storedFavorites).includes(this.recipe.urlName) : false;
            this.updateHeartColor();
        },
        modalOpen() {
            this.openModal = true;
            this.updateRecipePageStyle(true);
        },
        closeModal() {
            this.openModal = false;
            this.updateRecipePageStyle(false);
        },
        updateRecipePageStyle(isModalOpen) {
            const recipePageElement = this.$el.querySelector(".recipePage");
            if (recipePageElement) {
                if (isModalOpen) {
                    recipePageElement.style.height = "100dvh";
                    recipePageElement.style.overflowY = "hidden";
                } else {
                    recipePageElement.style.height = "auto";
                    recipePageElement.style.overflowY = "auto";
                }
            }
        },
        addServingToRecipe() {
            if (!this.recipe) return;
            const oldServings = this.recipe.servings;
            this.recipe.servings++;
            this.calculateIngredientAmounts(oldServings, this.recipe.servings);
        },
        removeServingToRecipe() {
            if (!this.recipe || this.recipe.servings <= 1) {
                if (this.recipe) this.recipe.servings = 1;
                return;
            }
            const oldServings = this.recipe.servings;
            this.recipe.servings--;
            this.calculateIngredientAmounts(oldServings, this.recipe.servings);
        },
        calculateIngredientAmounts(oldServings, newServings) {
            if (!this.recipe || !this.recipe.ingredients || oldServings === 0) return;
            this.recipe.ingredients = this.recipe.ingredients.map(ingredient => {
                const baseAmountPerOneServing = ingredient.amount / oldServings;
                let newAmount = baseAmountPerOneServing * newServings;
                let newUnit = ingredient.unit;

                // Changes units from ml to l and gram to kg and back when above or below 1000
                if (newUnit === 'ml' && newAmount >= 1000) {
                    newAmount = parseFloat((newAmount / 1000).toFixed(2));
                    newUnit = 'l';
                } else if (newUnit === 'gram' && newAmount >= 1000) {
                    newAmount = parseFloat((newAmount / 1000).toFixed(2));
                    newUnit = 'kg';
                } else if (newUnit === 'l' && newAmount < 1) {
                    newAmount = Math.round(newAmount * 1000);
                    newUnit = 'ml';
                } else if (newUnit === 'kg' && newAmount < 1) {
                    newAmount = Math.round(newAmount * 1000);
                    newUnit = 'gram';
                } else {
                    newAmount = parseFloat(newAmount.toFixed(2));
                }

                return { ...ingredient, amount: newAmount, unit: newUnit };
            });
        },
        checkScrollability() {
            this.isScrollable = document.documentElement.scrollHeight > document.documentElement.clientHeight;
            if (!this.isScrollable && !this.isScrolling) {
                this.footerVisible = true;
            } else if (this.isScrollable && !this.isScrolling) {
                this.footerVisible = (window.innerHeight + Math.ceil(window.scrollY)) >= document.documentElement.scrollHeight - 10;
            } else {
                this.footerVisible = false;
            }
        },
        handleScroll() {
            this.footerVisible = false;
            this.isScrolling = true;
            if (this.scrollTimeout) clearTimeout(this.scrollTimeout);
            this.scrollTimeout = setTimeout(() => {
                this.isScrolling = false;
                if (!this.isScrollable || (window.innerHeight + Math.ceil(window.scrollY)) >= document.documentElement.scrollHeight - 10) {
                    this.footerVisible = true;
                } else {
                    this.footerVisible = false;
                }
            }, 150);
        },
        toggleFavorite() {
            if (!this.recipe || !this.recipe.urlName) return;
            this.isFavorite = !this.isFavorite;
            const favoriteKey = 'favoriteRecipes';
            let favorites = JSON.parse(localStorage.getItem(favoriteKey)) || [];

            if (this.isFavorite) {
                if (!favorites.includes(this.recipe.urlName)) {
                    favorites.push(this.recipe.urlName);
                }
            } else {
                favorites = favorites.filter(url => url !== this.recipe.urlName);
            }
            localStorage.setItem(favoriteKey, JSON.stringify(favorites));
            this.updateHeartColor();
        },
        updateHeartColor() {
            this.heart = this.isFavorite ? "heart-fill" : "heart";
        }
    }
}
</script>