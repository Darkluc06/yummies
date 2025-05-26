<template>
    <div class="cookingDiagram__column" :class="indent ? `cookingDiagram__indentPadding` : ``">
        <figure class="cookingDiagram__line--startOfLine" v-if="startOfLine === true"></figure>
        <figure class="cookingDiagram__line cookingDiagram__line--active"
            :class="indent ? `cookingDiagram__indented` : ``"></figure>
        <div class="cookingDiagram__ingredient" v-if="isString === true && hasIngredientArrow === false">
            <div class="cookingDiagram__ingredientWrapper"
                :class="popupActive ? `` : `cookingDiagram__ingredientWrapper--active`" @click="OpenPopup()">
                <SvgIcon :name="`arrow-long`" />
                <p>{{ ingredientString }}</p>
            </div>
            <div class="cookingDiagram__ingredientPopup"
                :class="popupActive ? `cookingDiagram__ingredientPopup--active` : ``">
                <button @click="ClosePopup()">
                    <SvgIcon :name="`close`" />
                </button>
                <p>{{ ingredientString }}</p>
            </div>
        </div>
        <span class="cookingDiagram__icon" v-if="isString === false && hasIngredientArrow === false">
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
        <BackwardsArrow :steps="steps" :direction="backwardsArrowDirection" v-if="hasBackwardsArrow === true" />
        <Arrow v-if="hasIngredientArrow === true" :image="image" :image-alt="imageAlt" :difficulty="difficulty"
            :ingredient="ingredientString" :standard-arrow="standardArrow" :images="images" :indent="indent" />
        <figure class="cookingDiagram__brackets" v-if="hasBrackets === true" :class="`steps--${steps}`">
            <ul class="cookingDiagram__brackets--wrapper">
                <li class="cookingDiagram__brackets--left"></li>
                <li class="cookingDiagram__brackets--right"></li>
            </ul>
            <p class="cookingDiagram__brackets--text">{{ bracketText }}</p>
        </figure>
        <SvgIcon v-if="endOfLine === true" :name="`arrow-long`" :className="'cookingDiagram__line--endOfLine'" />
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
    data() {
        return {
            data: json.recipePage,
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
        imageAlt: {
            type: String
        },
        images: {
            type: Array,
            required: false
        },
        difficulty: {
            type: Number,
            default: 1,
        },
        active: {
            type: Boolean,
            default: false,
        },
        isCircle: {
            type: Boolean,
            default: true,
        },
        hasBackwardsArrow: {
            type: Boolean,
            default: false
        },
        steps: {
            type: String,
            default: "1"
        },
        backwardsArrowDirection: {
            type: String,
            default: "left"
        },
        hasIngredientArrow: {
            type: Boolean,
            default: false
        },
        hasBrackets: {
            type: Boolean,
            default: false
        },
        bracketText: {
            type: String,
            default: "",
        },
        standardArrow: {
            type: Boolean,
            default: true
        },
        indent: {
            type: Boolean,
            default: false,
            required: false,
        },
        startOfLine: {
            type: Boolean,
            default: false
        },
        endOfLine: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        recipe() {
            return this.data.recipes.find(recipe => this.recipeId === recipe.id);
        },
        ingredientString() {
            if (!this.recipe || !this.ingredients) {
                return "";
            }

            let ingredientsString = "";
            for (let i = 0; i < this.ingredients.length; i++) {
                const ingredientObject = this.ingredients[i];
                const recipeIngredient = this.recipe.ingredients[ingredientObject.index];

                if (recipeIngredient) {
                    let amountToDisplay = (recipeIngredient.amount / 100) * ingredientObject.percentageOfTotal;
                    let unitToDisplay = recipeIngredient.unit;

                    if (unitToDisplay === 'l' || unitToDisplay === 'kg') {
                        // Retain decimals for liters and kilograms
                        amountToDisplay = parseFloat(amountToDisplay.toFixed(2));
                    } else if (unitToDisplay === 'ml' || unitToDisplay === 'gram') {
                        // Round to whole numbers for ml/gram unless it is less than 1
                        if (amountToDisplay < 1 && amountToDisplay !== 0) {
                            amountToDisplay = parseFloat(amountToDisplay.toFixed(2));
                        } else {
                            amountToDisplay = Math.round(amountToDisplay);
                        }
                    } else {
                        amountToDisplay = Math.round(amountToDisplay);
                    }

                    ingredientsString += amountToDisplay + " " + unitToDisplay + " " + recipeIngredient.name;

                    if (this.ingredients.length - 1 !== i) {
                        ingredientsString += ", ";
                    }
                }
            }
            console.log('Ingredient - Final ingredientString (AFTER ROUNDING):', ingredientsString);
            return ingredientsString;
        }
    },
    methods: {
        OpenPopup() {
            this.popupActive = true;
        },
        ClosePopup() {
            this.popupActive = false;
        },
        CompletedStep() {
            this.finishedStep = !this.finishedStep;
        }
    }
}
</script>