<template>
    <div class="cookingDiagram__lineWrapper">
        <figure class="cookingDiagram__line cookingDiagram__line--active"></figure>
        <figure class="cookingDiagram__timeline" :class="`steps--${steps}`"></figure>
    </div>
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