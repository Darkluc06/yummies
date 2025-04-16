<template>
    <div class="cookingDiagram__column">
        <figure class="cookingDiagram__forloop" :class="`steps--${steps}`, `width--${width}`">
            <span class="cookingDiagram__forloopIcon">
                <div class="cookingDiagram__iconWrapper triangle">
                    <SvgIcon :name="name" />
                </div>
            </span>
        </figure>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components: {
        SvgIcon,
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