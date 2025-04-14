<template>
    <div class="cookingDiagram__column">
        <figure class="cookingDiagram__line cookingDiagram__line--active"></figure>
        <span class="cookingDiagram__ingredient" v-if="isString === true">
            <SvgIcon :name="`arrow-long`" />
            {{ ingedient }}
        </span>
        <span class="cookingDiagram__icon" v-if="isString === false">
            <div class="cookingDiagram__iconWrapper" :class="isCircle ? `circle` : `triangle`">
                <SvgIcon :name="icon" />
            </div>
            <ul class="cookingDiagram__difficultyWrapper">
                <li class="cookingDiagram__difficulty" v-for="(difficulty, index) in difficulty"></li>
            </ul>
        </span>
        <BackwardsArrow :steps="steps" :direction="backwardsArrowDirection" v-if="hasBackwardsArrow === true"/>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import BackwardsArrow from './backwardsArrow.vue';

export default {
    components: {
        SvgIcon,
        BackwardsArrow
    },
    props: {
        ingedient: {
            type: String,
            required: false
        },
        isString: {
            type: Boolean,
            default: true
        },
        icon: {
            type: String,
            required: false
        },
        difficulty: {
            type: Number,
            default: 1,
        },
        active:{
            type: Boolean,
            default: false,
        },
        isCircle:{
            type: Boolean,
            default: true,
        },
        hasBackwardsArrow:{
            type: Boolean,
            default: false
        },
        steps:{
            type: String,
            default: "1"
        },
        backwardsArrowDirection: {
            type: String,
            default: "left"
        }
    }
}

</script>