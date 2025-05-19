<template>
    <div class="cookingDiagram__column">
        <div class="cookingDiagram__lineWrapper">
            <figure class="cookingDiagram__line cookingDiagram__line--active"></figure>
            <figure class="cookingDiagram__timeline" :class="`steps--${steps}`">
                <p class="cookingDiagram__timeline--time">{{ time }}</p>
            </figure>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        steps: {
            type: String,
            default: "1"
        },
        time:{
            type: String,
            default: "1 min",
            required: false
        }
    }
}

</script>