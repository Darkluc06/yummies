<template>
    <div class="cookingDiagram__column">
        <div class="cookingDiagram__lineWrapper">
            <figure class="cookingDiagram__line"
                :class="active ? `cookingDiagram__line--active` : ``, end ? `cookingDiagram__line--end` : ``, indent ? `cookingDiagram__indented` : ``">
                <SvgIcon v-if="end === true" :name="`arrow-long`" />
            </figure>
            <SvgIcon v-if="hasSmallArrow === true" :name="`arrow-long`" />
        </div>
        <figure class="cookingDiagram__bigArrow" v-if="hasBigArrow === true">
            <svg-icon name="big-arrow" color="none" stroke="black" strokeWidth="1.2rem" />
        </figure>
    </div>

</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';


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
        hasSmallArrow: {
            type: Boolean,
            default: false,
            required: false,
        },
        end: {
            type: Boolean,
            default: false,
        },
        indent: {
            type: Boolean,
            default: false,
            required: false,
        },
    },
    components: {
        SvgIcon,
    },
};

</script>
