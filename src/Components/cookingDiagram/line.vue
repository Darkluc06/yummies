<template>
    <div class="cookingDiagram__column">
        <div class="cookingDiagram__lineWrapper">
            <ImageComponent :figure-class="'cookingDiagram__line--figure'" :image-class="'cookingDiagram__line--img'" :image-source="imgInLine" v-if="imgInLine != null" />
            <figure class="cookingDiagram__line--startOfLine" v-if="startOfLine === true"></figure>
            <figure class="cookingDiagram__line"
                :class="active ? `cookingDiagram__line--active` : ``, conectionArrow ? `cookingDiagram__line--end` : ``, indent ? `cookingDiagram__indented` : ``">
                <SvgIcon v-if="conectionArrow === true" :name="`arrow-long`" />
            </figure>
            <SvgIcon v-if="endOfLine === true" :name="`arrow-long`" :className="'cookingDiagram__line--endOfLine'" />
        </div>
        <figure class="cookingDiagram__bigArrow" v-if="hasBigArrow === true">
            <svg-icon name="big-arrow" color="none" stroke="black" strokeWidth="1.2rem" />
        </figure>
    </div>

</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import ImageComponent from '../general/image/imageComponent.vue';


export default {
    props: {
        active: {
            type: Boolean,
            default: false,
            required: false,
        },
        hasBigArrow: {
            type: Boolean,
            default: false,
            required: false,
        },
        conectionArrow: {
            type: Boolean,
            default: false,
        },
        indent: {
            type: Boolean,
            default: false,
            required: false,
        },
        startOfLine: {
            type: Boolean,
            default: false
        },
        imgInLine: {
            type: String,
        },
        endOfLine: {
            type: Boolean,
            default: false,
        }
    },
    components: {
        SvgIcon,
        ImageComponent
    },
};

</script>
