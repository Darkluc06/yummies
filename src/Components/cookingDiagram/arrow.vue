<template>
    <figure class="cookingDiagram__standardArrow" v-if="standardArrow === true">
        <SvgIcon :name="'arrow-long'" />
        <figure class="cookingDiagram__standardArrow--imgWrapper">
            <img :src="image" :alt="imageAlt" class="cookingDiagram__standardArrow--img">
        </figure>
        <section class="cookingDiagram__standardArrow--lineWrapper">
            <figure class="cookingDiagram__standardArrow--line"></figure>
            <p class="cookingDiagram__standardArrow--ingredient">{{ ingredient }}</p>
        </section>
    </figure>
    <figure class="cookingDiagram__specialArrow" v-if="standardArrow === false">
        <SvgIcon :name="'arrow-long'" />
        <ul class="cookingDiagram__specialArrow--difficulties">
            <li class="cookingDiagram__specialArrow--difficulty" v-for="(difficulty, index) in difficulty"></li>
        </ul>
        <figure class="cookingDiagram__specialArrow--imgWrapper" v-if="image">
            <img :src="image" :alt="imageAlt" class="cookingDiagram__specialArrow--img">
        </figure>
        <figure class="cookingDiagram__specialArrow--imgWrappers" v-if="images">
            <img :src="images.src" :alt="images.alt" class="cookingDiagram__specialArrow--imgs"  v-for="(images, index) in images">
        </figure>
        <div class="cookingDiagram__specialArrow--wrapper">
            <!-- <figure class="cookingDiagram__specialArrow--line"></figure> -->
            <p class="cookingDiagram__specialArrow--ingredient">{{ ingredient }}</p>
        </div>
    </figure>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components: {
        SvgIcon
    },
    props:{
        image: String,
        imageAlt: String,
        difficulty: {
            type: Number,
            default: 1,
        },
        ingredient:{
            type: String,
            default: ""
        },
        images:{
            type: Array,
            required: false
        },
        standardArrow:{
            type: Boolean,
            default: true
        }
    },
    mounted() {
        console.log(this.images);
    }
}

</script>