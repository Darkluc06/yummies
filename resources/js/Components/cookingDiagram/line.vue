<template>
    <div class="cookingDiagram__column">
        <div class="cookingDiagram__lineWrapper">
            <figure class="cookingDiagram__line" :class="active ? `cookingDiagram__line--active` : ``"></figure>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        active: {
            type: Boolean,
            default: false,
            required: false
        }
    }
}

</script>