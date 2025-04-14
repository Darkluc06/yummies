<template>
    <li class="recipe__item">
        <Link :href="`/recipe`" class="recipe__link">
            <imageComponent
                :figureClass="`recipe__figure`"
                :imageClass="`recipe__img`"
                :imageSource="`https://placehold.co/800x300`"
                :imageAlt="`test`"
            />
            <section class="recipe__text">
                <figure class="recipe__type">
                    <SvgIcon :name="`burger`" />
                </figure>
                <h3 class="recipe__title">Test</h3>
                <ul class="recipe__icons">
                    <li class="recipe__icon">
                        <button id="safeRecipe" class="recipe__span" @click="toggleSafeCount">
                            {{ safeCount }}
                            <svg id="heartSvg" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                            </svg>
                        </button>
                    </li>
                    <li class="recipe__icon">
                        <span class="recipe__span">
                            15 min <SvgIcon :name="`timer`" />
                        </span>
                    </li>
                </ul>
                <p class="recipe__paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum optio, vel distinctio itaque nihil fuga molestias voluptas temporibus architecto illum labore earum, dicta voluptate facere animi sint quia? Quod, excepturi.</p>
            </section>
        </Link>
    </li>
</template>

<script>
import imageComponent from '../general/image/imageComponent.vue';
import SvgIcon from '../general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: "recipeList",
    components: {
        imageComponent,
        SvgIcon,
        Link,
    },
    data() {
        return {
            safeCount: 8,
            originalSafeCount: 8,
            isSafeCountChanged: false,
        };
    },
    mounted() {
        if (localStorage.getItem("safeRecipe")) {
            this.safeCount = parseInt(localStorage.getItem("safeRecipe"));
            this.isSafeCountChanged = true;
            this.updateHeartColor(); 
        }
    },
    methods: {
        toggleSafeCount() {
            if (this.isSafeCountChanged) {
                this.safeCount = this.originalSafeCount;
                localStorage.removeItem("safeRecipe");
                this.isSafeCountChanged = false;
            } else {
                this.safeCount = this.safeCount + 1;
                localStorage.setItem("safeRecipe", this.safeCount);
                this.isSafeCountChanged = true;
            }
            this.updateHeartColor();
        },
        updateHeartColor() {
            const heartSvg = document.getElementById("heartSvg");
            if (heartSvg) {
                heartSvg.style.fill = this.isSafeCountChanged ? "red" : "currentColor";
            }
        },
    },
};
</script>
