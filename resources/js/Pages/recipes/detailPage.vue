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
                <h1 class="recipePage__title">Naam van recept</h1>
                <Link :href="`/`"><SvgIcon :name="`close`" /></Link>
            </div>
            <ul class="recipePage__icons">
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`timer`"/> 15 min 
                    </span>
                </li>
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`person`"/> 3
                    </span>
                </li>
                <li class="recipePage__icon">
                    <span>
                        <SvgIcon :name="`grocery`"/> 4 
                    </span>
                </li>
            </ul>
            <h2 class="recipePage__subTitle">
                Ingredienten
            </h2>
            <div class="recipePage__wrapper">
                <h3>3 Porties</h3>
                <div>
                    <button class="recipePage__button"><SvgIcon :name="`plus`"/></button>
                    <button class="recipePage__button"><SvgIcon :name="`minus`"/></button>
                </div>
            </div>
            <span class="recipePage__span">
                Verberg afbeeldingen
                <button class="recipePage__toggle" @click="toggleImage" :class="showImage ? `` : `recipePage__toggle--active`">
                    <figure class="recipePage__circle"></figure>
                </button>
            </span>
            <ul class="ingredients" :class="showImage ? `ingredients--image` : `ingredients--list`">
                <ingredients :shwoImage="showImage"/>
            </ul>
        </section>
    </article>
</template>

<script>

import imageComponent from '@/Components/general/image/imageComponent.vue';
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';
import ingredients from '@/Components/recipe/ingredients.vue';

export default {
    components:{
        imageComponent,
        SvgIcon,
        Link,
        ingredients
    },
    data(){
        return{
            showImage: false
        }
    },
    methods: {
        toggleImage(){
            this.showImage = !this.showImage;
        }
    }
}

</script>