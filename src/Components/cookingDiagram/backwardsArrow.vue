<template>
    <figure class="cookingDiagram__backwardsArrow" :class="`steps--${steps}`, indent ? `cookingDiagram__indentPadding` : ``">
        <div class="cookingDiagram__arrow" :class="`arrow--${direction}`" v-if="direction === `left`">
            <SvgIcon :name="`arrow-long`"/>
        </div>
        <div class="cookingDiagram__arrow" :class="`arrow--${direction}`" v-if="direction === `right`">
            <SvgIcon :name="`arrow-long`"/>
        </div>
    </figure>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components: {
        SvgIcon
    },
    props: {
        direction: {
            type: String,
            default: "left"
        },
        steps:{
            type: String,
            default: "1"
        },
        indent: {
            type: Boolean,
            default: false,
            required: false,
        },
    }
}

</script>
