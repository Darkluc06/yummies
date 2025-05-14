<template>
    <div class="modal" v-show="open">
        <section class="modal_modal">
            <header class="modal_header">
                <h2 class="modal_title">
                    Legenda
                </h2>
                <button class="modal_close" @click="modalClose">
                    <SvgIcon :name="`close`" />
                </button>
            </header>
            <p class="modal_summary">In deze legenda zie je alle symbolen en pijlen die voor dit recept gebruikt
                worden</p>
            <ul class="modal_container-icons">
                <li class="modal_icons" v-for="(iconImg, index) in this.icons" :key="index" v-if="icons">
                    <img class="modal_icon" :src="this.getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                    <span class="modal_icon-label">{{ iconImg.label }}</span>
                </li>
            </ul>
            <ul class="modal_container-colors"></ul>
        </section>
    </div>
</template>

<script>
import SvgIcon from '../general/svgIcon/SvgIcon.vue';
import json from '../../assets/json/recipe.json';

export default {
    props: {
        open: {
            type: Boolean,
            required: true,
            default: false,
        },
        recipe: {
            type: Object,
            required: true,
        }
    },
    components: {
        SvgIcon
    },
    data() {
        return {
            info: json,
            icons: [],
            recipes: json['recipePage']['recipes'],
        };
    },
    mounted() {
        this.getIcons()
    },
    methods: {
        modalClose() {
            this.$emit('close');
        },
        getIconUrl(filename) {
            return `${filename}`;
        },
        getIcons() {
            const existedIcons = [];
            if(this.recipe.diagram){
                this.icons = this.recipe.diagram
                .flat()  // Makes the diagram in the recipes 1 big array instead of multiple sub arrays
                .filter(objectCookingDiagram => objectCookingDiagram.image !== undefined)
                .map(objectCookingDiagram => ({
                    src: objectCookingDiagram.image,
                    alt: objectCookingDiagram.altImage
                }))
                .filter(icon => {
                    if (existedIcons.includes(icon.src)) {
                        return false;
                    }
                    existedIcons.push(icon.src);
                    return true;
                });
            }
        },
    },
};

</script>
