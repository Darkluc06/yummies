<template>
    <figure class="cookingDiagram__specialArrow">
        <SvgIcon :name="'arrow-long'" />
        <ul class="cookingDiagram__specialArrow--difficulties">
            <li class="cookingDiagram__specialArrow--difficulty" v-for="(difficulty, index) in difficulty"></li>
        </ul>
        <figure class="cookingDiagram__specialArrow--imgWrapper" v-if="image">
            <img :src="image" :alt="imageAlt" class="cookingDiagram__specialArrow--img">
        </figure>
        <figure class="cookingDiagram__specialArrow--imgWrappers" v-if="images">
            <img :src="images.src" :alt="images.alt" class="cookingDiagram__specialArrow--img"  v-for="(images, index) in images">
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
    },
    mounted() {
        console.log(this.images);
    }
}

</script>