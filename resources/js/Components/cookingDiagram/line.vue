<template>
    <div class="cookingDiagram__column">
        <div class="cookingDiagram__lineWrapper">
            <figure class="cookingDiagram__line"
                :class="active ? `cookingDiagram__line--active` : ``, end ? `cookingDiagram__line--end` : ``">
                <SvgIcon v-if="end === true" :name="`arrow-long`" />
            </figure>
            <SvgIcon v-if="hasSmallArrow === true" :name="`arrow-long`" />
        </div>
        <figure class="cookingDiagram__bigArrow" v-if="hasBigArrow === true">
            <svg xmlns="http://www.w3.org/2000/svg" width="20.5" height="39" viewBox="0 0 20.5 39">
                <g id="Polygon_7" data-name="Polygon 7" transform="translate(0 39) rotate(-90)" fill="none">
                    <path d="M19.5,0,39,20.5H0Z" stroke="none" />
                    <path
                        d="M 19.5 1.450927734375 L 2.331371307373047 19.5 L 36.66863250732422 19.5 L 19.5 1.450927734375 M 19.5 0 L 39 20.5 L 0 20.5 L 19.5 0 Z"
                        stroke="none" fill="#000" />
                </g>
            </svg>
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
            required: false
        },
        hasBigArrow: {
            type: Boolean,
            default: false,
            required: false
        },
        hasSmallArrow: {
            type: Boolean,
            default: false,
            required: false
        },
        end: {
            type: Boolean,
            default: false
        }
    },
    components: {
        SvgIcon
    }
}

</script>