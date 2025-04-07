<template>
    <div class="cookingDiagram__lineWrapper">
        <figure class="cookingDiagram__line" :class="active ? `cookingDiagram__line--active` : ``"></figure>
    </div>
</template>

<script>

export default {
    name: "lineComponent",
    props:{
        active:{
            type: Boolean,
            default: false,
            required: false
        }
    }
}

</script>