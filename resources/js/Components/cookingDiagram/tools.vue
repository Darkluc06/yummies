<template>
    <div class="cookingDiagram__column">
        <figure class="cookingDiagram__tool">
            <SvgIcon :name="tool" />
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
        tool: {
            type: String,
            default: "pan"
        }
    }
}

</script>