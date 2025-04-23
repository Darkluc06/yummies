<template>
    <figure :class="figureClass">
        <img :class="imageClass" :src="imageSource" :alt="imageAlt">
    </figure>
</template>

<script>
    export default {
        name: 'ImageComponent',
        props: {
            figureClass: String,
            imageClass: String,
            imageSource: String,
            imageAlt: String
        }
    }
</script>
