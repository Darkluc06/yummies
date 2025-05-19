<template>
    <figure class="cookingDiagram__specialArrow" :class="indent ? `cookingDiagram__indentPadding` : ``">
        <SvgIcon :name="'arrow-long'" />
        <ul class="cookingDiagram__specialArrow--difficulties">
            <li class="cookingDiagram__specialArrow--difficulty" v-for="(difficulty, index) in difficulty"></li>
        </ul>
        <figure class="cookingDiagram__specialArrow--imgWrapper">
            <img :src="image" :alt="imageAlt" class="cookingDiagram__specialArrow--img">
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
        indent: {
            type: Boolean,
            default: false,
            required: false,
        },
    }
}

</script>
