<template>
    <li class="recipe__item">
        <span class="recipe__favorite">
            <button id="safeRecipe-{{ recipe.id }}" class="recipe__span" @click="toggleFavorite">
                <SvgIcon :name="heart" />
            </button>
        </span>
        <Link :href="`/recipe`" :data="{name: recipe.urlName}" class="recipe__link">
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
                            <SvgIcon :name="`timer`" /> {{ recipe.time }}
                        </span>
                    </li>
                </ul>
                <p class="recipe__paragraph">{{ recipe.description }}</p>
            </section>
        </Link>
    </li>
</template>

<script>
import imageComponent from '../general/image/imageComponent.vue';
import SvgIcon from '../general/icon/SvgIcon.vue';
import iconComponent from '../general/icon/icon.vue'
import { Link } from '@inertiajs/vue3';

export default {
    name: "recipeList",
    components: {
        imageComponent,
        iconComponent,
        SvgIcon,
        Link
    },
    props: {
        recipe: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isFavorite: false,
            heart: "heart"
        };
    },
    mounted() {
        const favoriteKey = 'favoriteRecipes'; 
        const storedFavorites = localStorage.getItem(favoriteKey);
        this.isFavorite = storedFavorites ? JSON.parse(storedFavorites).includes(this.recipe.urlName) : false;
        this.updateHeartColor();
    },
    methods: {
        toggleFavorite() {
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
};
</script>
