<template>
    <div class="cookingDiagram__column">
        <figure class="cookingDiagram__line cookingDiagram__line--active"></figure>
        <div class="cookingDiagram__ingredient" v-if="isString === true">
            <SvgIcon :name="`arrow-long`" />
            <p>{{ this.ingredientsString }}</p>
        </div>
        <span class="cookingDiagram__icon" v-if="isString === false">
            <!-- <div class="cookingDiagram__iconWrapper" :class="isCircle ? `circle` : `triangle`">
                <SvgIcon :name="icon" />
            </div> -->
            <figure class="cookingDiagram__iconWrapper">
                <img :src="image" :alt="imageAlt" class="cookingDiagram__img">
            </figure>
            <ul class="cookingDiagram__difficultyWrapper">
                <li class="cookingDiagram__difficulty" v-for="(difficulty, index) in difficulty"></li>
            </ul>
        </span>
        <BackwardsArrow :steps="steps" :direction="backwardsArrowDirection" v-if="hasBackwardsArrow === true"/>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import BackwardsArrow from './backwardsArrow.vue';
import json from './../../../assets/json/data.json'

export default {
    components: {
        SvgIcon,
        BackwardsArrow,
    },
    data () {
        return {
            data : json.home,
            ingredientsString: "",
        }
    },
    props: {
        recipeId: {
            type: Number,
            required: true
        },
        ingredientIndecis: {
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
            if (this.ingredientIndecis === undefined) return;

            this.ingredientsString = "";

            for (let index = 0; index < this.ingredientIndecis.length; index++) {
                let ingredientIndex = this.ingredientIndecis[index];
                let ingredient = recipe.ingredients[ingredientIndex]

                this.ingredientsString += ingredient.amount + " " + ingredient.unit + " " + ingredient.name;

                if (this.ingredientIndecis.length - 1 !== index) {
                    this.ingredientsString += ", ";
                }
            }
        }
    }
}

</script>
