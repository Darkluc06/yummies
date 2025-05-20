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
            <div class="modal_containers">
                <ul class="modal_container-icons icons-condition">
                    <li class="modal_icons" v-for="(iconImg, index) in iconsCondition" :key="index"
                        v-if="iconsCondition">
                        <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="modal_icon-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
                <ul class="modal_container-icons icons-xyz">
                    <li class="modal_icons" v-for="(iconImg, index) in iconsXYZ" :key="index" v-if="iconsXYZ">
                        <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="modal_icon-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
                <ul class="modal_container-icons icons-circles">
                    <li class="modal_icons" v-for="(iconImg, index) in iconsCircles" :key="index" v-if="iconsCircles">
                        <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="modal_icon-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
                <ul class="modal_container-icons icons-diamonds">
                    <li class="modal_icons" v-for="(iconImg, index) in iconsDiamonds" :key="index" v-if="iconsDiamonds">
                        <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="modal_icon-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
                <ul class="modal_container-icons icons-intensity">
                    <p class="intensity-explanation">Intensiteit kan worden aangegeven op cond en acties van 0 naar 5.
                        Waar 5 het intens is en 0 niet gedefinieerd</p>
                    <li class="modal_icons" v-for="(iconImg, index) in iconsIntensity" :key="index"
                        v-if="iconsIntensity">
                        <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="modal_icon-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
                <ul class="modal_container-icons icons-arrows">
                    <p class="arrows-explanation">Een pijl, geeft aan dat alle elementen van de voorgaande moeten worden
                        verplaats naar een ander instrumen</p>
                    <li class="modal_icons" v-for="(iconImg, index) in iconsArrows" :key="index" v-if="iconsArrows">
                        <img class="modal_icon" :src="getIconUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="modal_icon-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
            </div>
            <div class="modal_ingredients">
                <div class="modal_ingredients-container">
                    <h2 class="modal_ingredients-h2">Ingrediënten:</h2>
                    <ul class="modal_ingredients">
                        <li class="modal_ingredients-ingredient blue" v-for="(ingredient, index) in ingredientsBlue"
                            :key="index">
                            <input class="modal_ingredients-checkbox" type="checkbox" />
                            <span>{{ ingredient.name }} {{ ingredient.amount }} {{ ingredient.unit }}</span>
                        </li>
                    </ul>
                    <ul class="modal_ingredients">
                        <li class="modal_ingredients-ingredient green" v-for="(ingredient, index) in ingredientsGreen"
                            :key="index">
                            <input class="modal_ingredients-checkbox" type="checkbox" />
                            <span>{{ ingredient.name }} {{ ingredient.amount }} {{ ingredient.unit }}</span>
                        </li>
                    </ul>
                    <ul class="modal_ingredients">
                        <li class="modal_ingredients-ingredient yellow" v-for="(ingredient, index) in ingredientsYellow"
                            :key="index">
                            <input class="modal_ingredients-checkbox" type="checkbox" />
                            <span>{{ ingredient.name }} {{ ingredient.amount }} {{ ingredient.unit }}</span>
                        </li>
                    </ul>
                    <ul class="modal_ingredients">
                        <li class="modal_ingredients-ingredient white">
                            <input class="modal_ingredients-checkbox" type="checkbox" />
                            <span>{{ ingredientsWhite.name }} {{ ingredientsWhite.amount }} {{ ingredientsWhite.unit }}</span>
                        </li>
                    </ul>
                </div>
            </div>
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
            iconsCondition: json['cooking-diagram']['iconsImgCondition'],
            iconsXYZ: json['cooking-diagram']['iconsXYZ'],
            iconsCircles: json['cooking-diagram']['iconsImgsCircle'],
            iconsDiamonds: json['cooking-diagram']['iconsImgsDiamond'],
            iconsIntensity: json['cooking-diagram']['iconsImgIntensity'],
            iconsArrows: json['cooking-diagram']['iconsImgArrows'],
            ingredientsBlue: json['cooking-diagram']['ingredients']['blueBox'],
            ingredientsGreen: json['cooking-diagram']['ingredients']['greenBox'],
            ingredientsYellow: json['cooking-diagram']['ingredients']['yellowBox'],
            ingredientsWhite: json['cooking-diagram']['ingredients']['whiteBox']

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
