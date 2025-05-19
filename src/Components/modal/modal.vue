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
import SvgIcon from '../general/icon/SvgIcon.vue';

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
            icons: [],
        };
    },
    mounted() {
        this.getIcons();
    },
    watch: {
        recipe: {
            handler: 'getIcons',
            deep: true
        }
    },
    methods: {
        modalClose() {
            this.$emit('close');
        },
        getIconUrl(filename) {
            return `${filename}`;
        },
        getIcons() {
            const processedIcons = [];
            const addedIconSources = new Set();

            if (this.recipe && this.recipe.diagram) {
                this.recipe.diagram
                    .flat()
                    .forEach(item => {
                        let iconToAdd = null;
                        if (item && item.image !== undefined) {
                            iconToAdd = {
                                src: item.image,
                                alt: item.altImage || 'Icon',
                                label: item.label || item.altImage || (item.type === 'Tools' && item.tool ? item.tool : 'Icon Label')
                            };
                        }
                        else if (item && item.type === "Line" && item.active === true && item['has-big-arrow'] === true) {
                            iconToAdd = {
                                src: '/img/verplaats_instrument.webp',
                                alt: 'Laat zien dat je van lijn moet wisselen',
                                label: 'Actie'
                            };
                        }
                        else if (item && item.type === "Tools" && item.tool === "pot" && item.image === undefined) {
                            iconToAdd = {
                                src: 'YOUR_PATH/pot-icon.svg',
                                alt: 'Pot tool',
                                label: 'Pot'
                            };
                        }
                        if (iconToAdd && iconToAdd.src && !addedIconSources.has(iconToAdd.src)) {
                            processedIcons.push(iconToAdd);
                            addedIconSources.add(iconToAdd.src);
                        }
                    });
                this.icons = processedIcons;
            } else {
                this.icons = [];
            }
        },
    },
};
</script>
