<template>
    <div class="cookingDiagram__column" :class="indent ? `cookingDiagram__indentPadding` : ``">
        <p class="cookingDiagram__timeline--time">{{ time }}</p>
        <div class="cookingDiagram__lineWrapper">
            <figure class="cookingDiagram__line cookingDiagram__line--active"></figure>
            <ul class="cookingDiagram__timeline" :class="`steps--${steps}`">
                <figure class="cookingDiagram__timeline--line"></figure>
                <li class="cookingDiagram__timeline--divider cookingDiagram__timeline--divider-top"></li>
                <li class="cookingDiagram__timeline--divider cookingDiagram__timeline--divider-bottom"></li>
            </ul>
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
        time: {
            type: String,
            default: "1 min",
            required: false
        },
        indent:{
            type: Boolean,
            default: false
        }
    }
}

</script>