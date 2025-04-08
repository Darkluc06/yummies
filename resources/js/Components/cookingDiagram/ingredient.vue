<template>
    <div class="cookingDiagram__column">
        <span class="cookingDiagram__ingredient" v-if="isString === true">
            <SvgIcon :name="`arrow`" />
            {{ ingedient }}
        </span>
        <figure class="cookingDiagram__icon" v-if="isString === false">
            <SvgIcon :name="icon" />
            <div class="cookingDiagram__difficulty" v-for="(difficulty, index) in difficulty"></div>
        </figure>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components: {
        SvgIcon
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
        }
    }
}

</script>