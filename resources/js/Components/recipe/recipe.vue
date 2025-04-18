<template>
    <li class="recipe__item">
        <span class="recipe__favorite">
            <button id="safeRecipe-{{ recipe.id }}" class="recipe__span" @click="toggleFavorite">
                <svg
                    :id="`heartSvg-${recipe.id}`"
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    class="bi bi-heart-fill"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"
                    />
                </svg>
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
        };
    },
    mounted() {
        const favoriteKey = `favoriteRecipe-${this.recipe.id}`;
        this.isFavorite = localStorage.getItem(favoriteKey) === 'true';
        this.updateHeartColor();
    },
    methods: {
        toggleFavorite() {
            this.isFavorite = !this.isFavorite;
            const favoriteKey = `favoriteRecipe-${this.recipe.id}`;
            localStorage.setItem(favoriteKey, this.isFavorite);
            this.updateHeartColor();
        },
        updateHeartColor() {
            const heartSvg = document.getElementById(`heartSvg-${this.recipe.id}`);
            if (heartSvg) {
                heartSvg.style.fill = this.isFavorite ? "red" : "currentColor";
            }
        }
    }
};
</script>
