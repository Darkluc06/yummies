<template>
    <DesktopNavigation :title="'Kook Diagram'" />
    <div class="instruction">
        <article id="instruction_documentation" class="instruction_documentation">
            <section class="instruction_documentation-top">
                <header class="instruction_documentation-header">
                    <h1 class="instruction_documentation-h1"> {{ instruction.documentation.title }} </h1>
                    <RouterLink class="instruction_documentation-close" :to="`/`">
                        <SvgIcon :name="`close`" />
                    </RouterLink>
                </header>
                <div class="instruction__buttonWrapper">
                    <RouterLink class="instruction_legenda-button" activeClass="instruction_legenda-button--active" :to="'/documentation'">Documentatie</RouterLink>
                    <RouterLink class="instruction_legenda-button" activeClass="instruction_legenda-button--active" :to="'/legenda'">Legenda</RouterLink>
                </div>
            </section>
            <section class="instructions_documentation-mid">
                <p class="instructions_documentation-p">
                    {{ instruction.documentation.paragraph }}
                </p>
            </section>
        </article>
    </div>
    <FooterComponent :class="{ hidden: !footerVisible }"></FooterComponent>
</template>

<script>
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { RouterLink } from 'vue-router';
import json from '../../assets/json/data.json';
import FooterComponent from '../../Components/footer/footerComponent.vue';
import DesktopNavigation from '@/Components/navigation/desktopNavigation.vue';

export default {
    components: {
        SvgIcon,
        RouterLink,
        FooterComponent,
        DesktopNavigation
    },
    data() {
        return {
            instruction: json["instruction"],
            icons: json["instruction"]["legenda"]["imgs"],

            info: json,
            iconsCondition: json['instruction']['legenda']['iconsImgCondition'],
            iconsXYZ: json['instruction']['legenda']['iconsXYZ'],
            iconsCircles: json['instruction']['legenda']['iconsImgsCircle'],
            iconsDiamonds: json['instruction']['legenda']['iconsImgsDiamond'],
            iconsIntensity: json['instruction']['legenda']['iconsImgIntensity'],
            iconsArrows: json['instruction']['legenda']['iconsImgArrows'],
            ingredientsBlue: json['instruction']['legenda']['ingredients']['blueBox'],
            ingredientsGreen: json['instruction']['legenda']['ingredients']['greenBox'],
            ingredientsYellow: json['instruction']['legenda']['ingredients']['yellowBox'],
            ingredientsWhite: json['instruction']['legenda']['ingredients']['whiteBox'],

            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
        };
    },
    mounted() {
        this.checkScrollability();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        getImgUrl(filename) {
            return `/img/${filename}`;
        },
        checkScrollability() {
            this.isScrollable = document.body.scrollHeight > document.body.clientHeight;
            if (!this.isScrollable && !this.isScrolling) {
                this.footerVisible = true;
            } else {
                this.footerVisible = false;
            }
        },
        handleScroll() {
            this.footerVisible = false;
            this.isScrolling = true;
            clearTimeout(this.scrollTimeout);
            this.scrollTimeout = setTimeout(() => {
                this.isScrolling = false;
                this.checkScrollability();
            }, 100);
        },
    },


};
</script>
