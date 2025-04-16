<template>
    <li class="recipe__item">
        <a :href="`/recepten/${recipe.name.toLowerCase().replace(/ /g, '-')}`" class="recipe__link">
            <imageComponent
                :figureClass="`recipe__figure`"
                :imageClass="`recipe__img`"
                :imageSource="recipe.image || `https://placehold.co/800x300`"
                :imageAlt="recipe.name"
            />
            <section class="recipe__text">
                <figure class="recipe__type">
                    <iconComponent :icon="recipe.type" />
                </figure>
                <h3 class="recipe__title">{{ recipe.name }}</h3>
                <ul class="recipe__icons">
                    <li class="recipe__icon">
                        <span class="recipe__span">
                            {{ recipe.time }} <SvgIcon :name="`timer`"/>
                        </span>
                    </li>
                    <li class="recipe__icon">
                        <span class="recipe__span">
                            {{ recipe.likes }} <SvgIcon :name="`heart`"/>
                        </span>
                    </li>
                </ul>
                <p class="recipe__paragraph">{{ recipe.description }}</p>
            </section>
        </a>
    </li>
</template>

<script>
import imageComponent from '../general/image/imageComponent.vue';
import SvgIcon from '../general/icon/SvgIcon.vue';
import iconComponent from '../general/icon/icon.vue'

export default {
    name: "recipeList",
    components:{
        imageComponent,
        iconComponent,
        SvgIcon
    },
    props: {
        recipe: {
            type: Object,
            required: true
        }
    }
}
</script>
