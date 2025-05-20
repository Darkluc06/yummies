<template>
    <DesktopNavigation :title="'Kook Diagram'" />
    <div class="instruction">
        <article id="instruction_documentation" class="instruction_documentation">
            <section class="instruction_documentation-top">
                <header class="instruction_documentation-header">
                    <h1 class="instruction_documentation-h1"> {{ instruction.documentation.title }} </h1>
                    <div class="instruction__buttonWrapper">
                        <RouterLink class="instruction_legenda-button" activeClass="instruction_legenda-button--active"
                            :to="'/documentation'">Documentatie</RouterLink>
                        <RouterLink class="instruction_legenda-button" activeClass="instruction_legenda-button--active"
                            :to="'/legenda'">Legenda</RouterLink>
                    </div>
                </header>
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
import DesktopNavigation from '@/Components/navigation/desktopNavigation.vue';
import instruction from '/src/assets/json/instruction.json';
import FooterComponent from '/src/Components/footer/footerComponent.vue';

export default {
    components: {
        SvgIcon,
        RouterLink,
        FooterComponent,
        DesktopNavigation
    },
    data() {
        return {
            showDocumentation: true,
            instruction: instruction,

            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
        };
    },
    mounted() {
        this.checkScrollability();
        this.setPopUpArrow();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        setPopUpArrow () {
            localStorage.setItem("arrow", "true");
        },
        goToDocumentation() {
            this.showDocumentation = true;
        },
        goToLegenda() {
            this.showDocumentation = false;
        },
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
