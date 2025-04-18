<template>
    <article class="recipePage">
        <imageComponent
            :figureClass="`recipePage__figure`"
            :imageClass="`recipePage__img`"
            :imageSource="`https://placehold.co/900x400`"
            :imageAlt="`test`"
        />
        <section class="recipePage__text">
            <figure class="recipe__type">
                    <SvgIcon :name="`burger`" />
            </figure>
            <div class="recipePage__wrapper">
                <h1 class="recipePage__title">{{ this.recipe.name }}</h1>
                <Link :href="`/`"><SvgIcon :name="`close`" /></Link>
            </div>
            <ul class="recipePage__icons">
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`timer`"/> {{ this.recipe.time }}
                    </span>
                </li>
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`grocery`"/> {{ this.recipe.ingredients.length }}
                    </span>
                </li>
            </ul>
            <h2 class="recipePage__subTitle">
                Ingrediënten
            </h2>
            <div class="recipePage__wrapper">
                <h3> {{ this.recipe.servings }} porties </h3>
                <div>
                    <button class="recipePage__button" @click="removeServingToRecipe"><SvgIcon :name="`minus`"/></button>
                    <button class="recipePage__button" @click="addServingToRecipe"><SvgIcon :name="`plus`"/></button>
                </div>
            </div>
            <ul class="ingredients ingredients--list">
                <ingredients
                        v-for="ingredient in this.recipe.ingredients"
                        :key="ingredient.amount"
                        :ingredient="ingredient"
                    />
            </ul>
            <div class="recipePage__wrapper">
                <h2 class="recipePage__subTitle">Kookdiagram </h2>
                <button @click="modalOpen" class="recipePage__modalButton">Legenda</button>
            </div>
            <cookingDiagram />
        </section>
        <modal :open="openModal" @close="closeModal" />
    </article>
</template>

<script>

import imageComponent from '@/Components/general/image/imageComponent.vue';
import SvgIcon from '@/Components/general/svgIcon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';
import ingredients from '@/Components/recipe/ingredients.vue';
import modal from '@/Components/modal/modal.vue';
import cookingDiagram from '@/Components/cookingDiagram/cookingDiagram.vue';
import json from './../../../assets/json/data.json';

export default {
    components:{
        imageComponent,
        SvgIcon,
        Link,
        ingredients,
        modal,
        cookingDiagram
    },
    data(){
        return{
            openModal: false,
            recipe: null,
        }
    },
    created()
    {
        let urlParams = new URLSearchParams(window.location.search);
        this.recipe = json.home.recipes.find(recipe => recipe.urlName === urlParams.get('name'));
    },
    methods: {
        modalOpen(){
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
            if(this.recipe.servings <= 1) {
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
        }
    }
}

</script>
