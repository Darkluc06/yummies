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
            <ul class="ingredients ingredients--list">
                <ingredients/>
                <ingredients/>
                <ingredients/>
                <ingredients/>
                <ingredients/>
                <ingredients/>
                <ingredients/>
            </ul>
            <div class="recipePage__wrapper">
                <h2 class="recipePage__subTitle">Kookdiagram </h2>
                <button @click="modalOpen" class="recipePage__modalButton">Legenda</button>
            </div>
        </section>
        <modal :title="`Leganda`" :open="openModal" @close="closeModal" />
    </article>
</template>

<script>

import imageComponent from '@/Components/general/image/imageComponent.vue';
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';
import ingredients from '@/Components/recipe/ingredients.vue';
import modal from '@/Components/modal/modal.vue';

export default {
    components:{
        imageComponent,
        SvgIcon,
        Link,
        ingredients,
        modal
    },
    data(){
        return{
            openModal: false
        }
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
    }
}

</script>