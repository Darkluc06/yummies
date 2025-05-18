<template>
    <div class="cookingDiagram__column">
        <figure class="cookingDiagram__line cookingDiagram__line--active"></figure>
        <div class="cookingDiagram__ingredient" v-if="isString === true && hasIngredientArrow === false">
            <div class="cookingDiagram__ingredientWrapper" :class="popupActive ? `` : `cookingDiagram__ingredientWrapper--active`" @click="OpenPopup()">
                <SvgIcon :name="`arrow-long`" />
                <p>{{ this.ingredientsString }}</p>
            </div>
            <div class="cookingDiagram__ingredientPopup" :class="popupActive ? `cookingDiagram__ingredientPopup--active` : ``">
                <button @click="ClosePopup()">
                    <SvgIcon :name="`close`"/>
                </button>
                <p>{{ this.ingredientsString }}</p>
            </div>
        </div>
        <span class="cookingDiagram__icon" v-if="isString === false && hasIngredientArrow === false">
            <!-- <div class="cookingDiagram__iconWrapper" :class="isCircle ? `circle` : `triangle`">
                <SvgIcon :name="icon" />
            </div> -->
            <figure class="cookingDiagram__iconWrapper" @click="CompletedStep()">
                <img :src="image" :alt="imageAlt" class="cookingDiagram__img">
                <div class="cookingDiagram__completed" :class="finishedStep ? `cookingDiagram__completed--active` : ``">
                    <SvgIcon :name="`check`" />
                </div>
            </figure>
            <ul class="cookingDiagram__difficultyWrapper">
                <li class="cookingDiagram__difficulty" v-for="(difficulty, index) in difficulty"></li>
            </ul>
        </span>
        <BackwardsArrow :steps="steps" :direction="backwardsArrowDirection" v-if="hasBackwardsArrow === true"/>
        <Arrow v-if="hasIngredientArrow === true" :image="image" :image-alt="imageAlt" :difficulty="difficulty" :ingredient="this.ingredientsString" />
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import BackwardsArrow from './backwardsArrow.vue';
import Arrow from './arrow.vue';
import json from '../../assets/json/recipe.json'

export default {
    components: {
        SvgIcon,
        BackwardsArrow,
        Arrow
    },
    data () {
        return {
            data : json.recipePage,
            ingredientsString: "",
            popupActive: false,
            finishedStep: false,
        }
    },
    props: {
        recipeId: {
            type: Number,
            required: true
        },
        ingredients: {
            type: Array,
            required: false
        },
        isString: {
            type: Boolean,
            default: true
        },
        image: {
            type: String,
            required: false
        },
        imageAlt:{
            type: String
        },
        difficulty: {
            type: Number,
            default: 1,
        },
        active:{
            type: Boolean,
            default: false,
        },
        isCircle:{
            type: Boolean,
            default: true,
        },
        hasBackwardsArrow:{
            type: Boolean,
            default: false
        },
        steps:{
            type: String,
            default: "1"
        },
        backwardsArrowDirection: {
            type: String,
            default: "left"
        },
        hasIngredientArrow:{
            type: Boolean,
            default: false
        }
    },
    mounted() {
        let recipe = this.getRecipe();
        this.setIngredientString(recipe)
    },
    beforeUpdate()
    {
        let recipe = this.getRecipe();
        this.setIngredientString(recipe)
    },
    methods: {
        getRecipe() {
            return this.data.recipes.find(recipe => this.recipeId === recipe.id);
        },
        setIngredientString(recipe)
        {
            if (this.ingredients === undefined) return;
            this.ingredientsString = "";

            for (let index = 0; index < this.ingredients.length; index++) {
                let ingredientObject = this.ingredients[index];
                let recipeIngredient = recipe.ingredients[ingredientObject.index]
                this.ingredientsString += (recipeIngredient.amount / 100 * ingredientObject.percentageOfTotal) + " " + recipeIngredient.unit + " " + recipeIngredient.name;

                if (this.ingredients.length - 1 !== index) {
                    this.ingredientsString += ", ";
                }
            }
        },
        OpenPopup(){
            this.popupActive = true;
        },
        ClosePopup(){
            this.popupActive = false;
        },
        CompletedStep(){
            this.finishedStep = !this.finishedStep;
        }
    }
}

</script>
