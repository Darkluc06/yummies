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
            const addedCanonizedSources = new Set();
            const canonizeSrc = (srcPath) => {
                if (!srcPath) return null;
                try {
                    const baseUrl = window.location.origin;
                    return new URL(srcPath, baseUrl).pathname;
                } catch (e) {
                    return srcPath;
                }
            };

            if (this.recipe && this.recipe.diagram) {
                this.recipe.diagram
                    .flat()
                    .forEach(item => {
                        let iconToAdd = null;
                        let originalSrc = null;

                        if (!item) return;

                        if (item.type === "Ingredient" &&
                            item['is-string'] === false &&
                            item.difficulty !== undefined &&
                            item.difficulty >= 1) {
                            originalSrc = '/img/intensiteit3Cirkel.webp';
                            iconToAdd = {
                                src: originalSrc,
                                alt: 'Moeilijkheidsgraad',
                                label: `Intensiteit van de actie`
                            };
                        } else if (item.image !== undefined) {
                            originalSrc = item.image;
                            iconToAdd = {
                                src: originalSrc,
                                alt: item.imageAlt || item.altImage || 'Icon',
                                label: item.label || item.imageAlt || item.altImage || (item.type === 'Tools' && item.tool ? item.tool : 'Icon Label')
                            };
                        } else if (item.type === "Line" && item.active === true && item['has-big-arrow'] === true) {
                            originalSrc = '/img/verplaats_instrument.webp';
                            iconToAdd = {
                                src: originalSrc,
                                alt: 'Laat zien dat je van lijn moet wisselen',
                                label: 'Actie'
                            };
                        }

                        if (iconToAdd && originalSrc) {
                            const canonizedVersion = canonizeSrc(originalSrc);
                            if (canonizedVersion && !addedCanonizedSources.has(canonizedVersion)) {
                                processedIcons.push(iconToAdd);
                                addedCanonizedSources.add(canonizedVersion);
                            }
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
