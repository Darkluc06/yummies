<template>
    <div class="cookingDiagram__column">
        <div class="cookingDiagram__lineWrapper">
            <figure class="cookingDiagram__line"></figure>
        </div>
        <figure class="cookingDiagram__forloop" :class="`steps--${steps}`, `width--${width}`">
            <span class="cookingDiagram__forloopIcon">
                <!-- <div class="cookingDiagram__iconWrapper triangle">
                    <SvgIcon :name="name" />
                </div> -->
                <ImageComponent :figure-class="`cookingDiagram__iconWrapper`" :image-class="`cookingDiagram__img`" :image-source="image" :image-alt="`test`" v-if="image != null" />
            </span>
        </figure>
    </div>
</template>

<script>

import ImageComponent from '../general/image/imageComponent.vue';

export default {
    components: {
        ImageComponent
    },
    props: {
        name: {
            type: String,
            default: "twitter"
        },
        steps: {
            type: String,
            default: "1"
        },
        width: {
            type: String,
            default: "1"
        },
        image:{
            type: String,
        }
    }
}

</script>