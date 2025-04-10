<template>
    <div class="modal" v-show="open">
        <section class="modal_modal">
            <header class="modal_header">
                <h2 class="modal_title">
                    {{ info['cooking-diagram'].title }}
                </h2>
                <button class="modal_close" @click="modalClose">
                    <SvgIcon :name="`close`" />
                </button>
            </header>
            <summary class="modal_summary">{{ info['cooking-diagram'].summary }}</summary>
            <ul class="modal_container-icons">
                <li class="modal_icons" v-for="(iconImg, index) in icons" :key="index" v-if="icons">
                    <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                    <span class="modal_icon-label">{{ iconImg.label }}</span>
                </li>
            </ul>
            <ul class="modal_container-colors"></ul>
        </section>
    </div>
</template>

<script>
import SvgIcon from '../general/svgIcon/SvgIcon.vue';
import json from './../../../../resources/assets/jason/data.json';

export default {
    props: {
        open: {
            type: Boolean,
            required: true,
            default: false,
        },
    },
    components: {
        SvgIcon
    },
    data() {
        return {
            info: json,
            icons: json['cooking-diagram']['iconsImgs'],
        };
    },
    methods: {
        modalClose() {
            this.$emit('close');
        },
        getIconUrl(filename) {
            return `/img/${filename}`;
        }
    },
};
</script>
