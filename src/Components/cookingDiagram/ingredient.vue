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
            <ul class="cookingDiagram__difficultyWrapper" v-if="difficulty > 0">
                <li class="cookingDiagram__difficulty" v-for="(difficulty, index) in difficulty"></li>
            </ul>
        </span>
        <BackwardsArrow :steps="steps" :direction="backwardsArrowDirection" v-if="hasBackwardsArrow === true"/>
        <Arrow v-if="hasIngredientArrow === true" :image="image" :image-alt="imageAlt" :difficulty="difficulty" :ingredient="this.ingredientsString" :images="images" :standard-arrow="standardArrow" />
        <figure class="cookingDiagram__brackets" v-if="hasBrackets === true" :class="`steps--${steps}`">
            <ul class="cookingDiagram__brackets--wrapper">
                <li class="cookingDiagram__brackets--left"></li>
                <li class="cookingDiagram__brackets--right"></li>
            </ul>
            <p class="cookingDiagram__brackets--text">{{ bracketText }}</p>
        </figure>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import BackwardsArrow from './backwardsArrow.vue';
import Arrow from './arrow.vue';
import json from '../../assets/json/data.json'

export default {
    components: {
        SvgIcon,
        BackwardsArrow,
        Arrow
    },
    data () {
        return {
            data : json.home,
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
        ingredientIndexes: {
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
        images:{
            type: Array,
            required: false
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
        },
        hasBrackets:{
            type: Boolean,
            default: false
        },
        bracketText:{
            type: String,
            default: "",
        },
        standardArrow:{
            type: Boolean,
            default: true
        }
    },
    mounted() {
        this.searchRecipeId()
    },
    beforeUpdate()
    {
        this.searchRecipeId()
    },
    methods: {
        searchRecipeId() {
            let recipe = this.data.recipes.find(recipe => this.recipeId === recipe.id);
            if (this.ingredientIndexes === undefined) return;

            this.ingredientsString = "";

            for (let index = 0; index < this.ingredientIndexes.length; index++) {
                let ingredientIndex = this.ingredientIndexes[index];
                let ingredient = recipe.ingredients[ingredientIndex]

                this.ingredientsString += ingredient.amount + " " + ingredient.unit + " " + ingredient.name;

                if (this.ingredientIndexes.length - 1 !== index) {
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
