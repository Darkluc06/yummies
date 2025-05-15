<template>
    <div class="cookingDiagram__lineWrapper">
        <figure class="cookingDiagram__line"></figure>
    </div>
    <figure class="cookingDiagram__timeline" :class="`steps--${steps}`"></figure>
</template>

<script>

export default {
    props: {
        steps: {
            type: String,
            default: "1"
        }
    }
}

</script>