<template>
    <div class="cookingDiagram__column">
        <figure class="cookingDiagram__forloop" :class="`steps--${steps}`, `width--${width}`">
            <span class="cookingDiagram__forloopIcon">
                <!-- <div class="cookingDiagram__iconWrapper triangle">
                    <SvgIcon :name="name" />
                </div> -->
                <ImageComponent :figure-class="`cookingDiagram__iconWrapper`" :image-class="`cookingDiagram__img`" :image-source="`../img/actie_x.webp`" :image-alt="`test`" />
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
        }
    }
}

</script>