<template>
    <div class="instruction">
        <article id="instruction_documentation" class="instruction_documentation" v-if="showDocumentation">
            <section class="instruction_documentation-top">
                <header class="instruction_documentation-header">
                    <h1 class="instruction_documentation-h1"> {{ instruction.documentation.title }} </h1>
                    <RouterLink class="instruction_documentation-close" :to="`/`">
                        <SvgIcon :name="`close`" />
                    </RouterLink>
                </header>
                <div class="instruction__buttonWrapper">
                    <button class="instruction_documentation-button instruction_documentation-button--active" @click="goToDocumentation"> {{
                        instruction.buttons['button-documentation'] }} </button>
                    <button class="instruction_legenda-button" @click="goToLegenda"> {{
                        instruction.buttons["button-legenda"] }} </button>
                </div>
            </section>
            <section class="instructions_documentation-mid">
                <p class="instructions_documentation-p">
                    {{ instruction.documentation.paragraph }}
                </p>
            </section>
        </article>
        <article id="instruction_legenda" class="instruction_legenda" v-else>
            <section class="instruction_legenda-top">
                <header class="instruction_legenda-header">
                    <h1 class="instruction_legenda-h1"> {{ instruction.legenda.title }} </h1>
                    <Link class="instruction_legenda-close" :href="`/`" />
                    <SvgIcon :name="`close`" />
                </header>
                <div class="instruction__buttonWrapper">
                    <button class="instruction_legenda-button" @click="goToDocumentation"> {{
                        instruction.buttons['button-documentation'] }} </button>
                    <button class="instruction_legenda-button instruction_legenda-button--active" @click="goToLegenda"> {{
                        instruction.buttons["button-legenda"] }} </button>
                </div>
            </section>
            <section class="instruction_legenda-mid">
                <p class="instruction_legenda-summary"> {{ instruction.legenda.summary }} </p>
                <div class="instruction_containers">
                    <ul class="instruction_container-icons icons-condition">
                        <li class="instruction_icons" v-for="(iconImg, index) in iconsCondition" :key="index"
                            v-if="iconsCondition">
                            <img class="instruction_icon" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                            <span class="instruction_icon-label">{{ iconImg.label }}</span>
                        </li>
                    </ul>
                    <ul class="instruction_container-icons icons-xyz">
                        <li class="instruction_icons" v-for="(iconImg, index) in iconsXYZ" :key="index" v-if="iconsXYZ">
                            <img class="instruction_icon" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                            <span class="instruction_icon-label">{{ iconImg.label }}</span>
                        </li>
                    </ul>
                    <ul class="instruction_container-icons icons-circles">
                        <li class="instruction_icons" v-for="(iconImg, index) in iconsCircles" :key="index"
                            v-if="iconsCircles">
                            <img class="instruction_icon" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                            <span class="instruction_icon-label">{{ iconImg.label }}</span>
                        </li>
                    </ul>
                    <ul class="instruction_container-icons icons-diamonds">
                        <li class="instruction_icons" v-for="(iconImg, index) in iconsDiamonds" :key="index"
                            v-if="iconsDiamonds">
                            <img class="instruction_icon" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                            <span class="instruction_icon-label">{{ iconImg.label }}</span>
                        </li>
                    </ul>
                  <p class="intensity-explanation">Intensiteit kan worden aangegeven op cond en acties van 0 naar
                    5.
                    Waar 5 het intens is en 0 niet gedefinieerd
                  </p>
                    <ul class="instruction_container-icons icons-intensity">

                        <li class="instruction_icons" v-for="(iconImg, index) in iconsIntensity" :key="index"
                            v-if="iconsIntensity">
                            <img class="instruction_icon" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                            <span class="instruction_icon-label">{{ iconImg.label }}</span>
                        </li>
                    </ul>
                  <p class="arrows-explanation">Een pijl, geeft aan dat alle elementen van de voorgaande moeten
                    worden
                    verplaats naar een ander instrumen</p>
                    <ul class="instruction_container-icons icons-arrows">

                        <li class="instruction_icons" v-for="(iconImg, index) in iconsArrows" :key="index"
                            v-if="iconsArrows">
                            <img class="instruction_icon" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                            <span class="instruction_icon-label">{{ iconImg.label }}</span>
                        </li>
                    </ul>
                </div>
                <figure class="instruction_figure">
                    <p class="instruction_figure-p"> De onderstaande afbeelding geeft aan dat je iets tijdelijk blijvend
                        moet
                        doen
                    </p>
                    <img src="/img/iets_blijven_doen.webp" alt="" class="instruction_img-keep-doing">
                </figure>
                <div class="instruction_ingredients">
                    <p class="instruction_ingredients-p">Verschillende onderdelen (moeten) afgebeeld worden in
                        (kleur)vakken,
                        zodat je
                        makkelijk kan zien
                        wat bepaalde stappen doen. Het item naam en symbolen in het vak blijven wit. Vervolgens staan de
                        ingredienten op volgorde van wat er
                        als eerst in gaat en op volgorde van kleur.</p>
                    <img src="/img/colors.webp" alt="" class="instruction_ingredients-img">
                    <p class="instruction_ingredients-p">
                        In de ingredienten staan eerst de hoeveelheid. Altijd in eenheiden, grammen, liters, eetlepels
                        of thee lepels. En dan de naam. Wanneer een ingredient in twee blokken voorkomt
                        komt bij zonder kleur boven aan
                    </p>
                    <div class="instruction_ingredients-container">
                        <h2 class="instruction_ingredients-h2">Ingrediënten:</h2>
                        <ul class="instruction_ingredients">
                            <li class="instruction_ingredients-ingredient blue"
                                v-for="(ingredient, index) in ingredientsBlue" :key="index">
                                <input class="instruction_ingredients-checkbox" type="checkbox" />
                                <span>{{ ingredient.name }} {{ ingredient.amount }} {{ ingredient.unit }}</span>
                            </li>
                        </ul>
                        <ul class="instruction_ingredients">
                            <li class="instruction_ingredients-ingredient green"
                                v-for="(ingredient, index) in ingredientsGreen" :key="index">
                                <input class="instruction_ingredients-checkbox" type="checkbox" />
                                <span>{{ ingredient.name }} {{ ingredient.amount }} {{ ingredient.unit }}</span>
                            </li>
                        </ul>
                        <ul class="instruction_ingredients">
                            <li class="instruction_ingredients-ingredient yellow"
                                v-for="(ingredient, index) in ingredientsYellow" :key="index">
                                <input class="instruction_ingredients-checkbox" type="checkbox" />
                                <span>{{ ingredient.name }} {{ ingredient.amount }} {{ ingredient.unit }}</span>
                            </li>
                        </ul>
                        <ul class="instruction_ingredients">
                            <li class="instruction_ingredients-ingredient white">
                                <input class="instruction_ingredients-checkbox" type="checkbox" />
                                <span>{{ ingredientsWhite.name }} {{ ingredientsWhite.amount }} {{
                                    ingredientsWhite.unit }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </article>
    </div>
    <FooterComponent :class="{ hidden: !footerVisible }"></FooterComponent>
</template>

<script>
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { RouterLink } from 'vue-router';
import instruction from '/src/assets/json/instruction.json';
import FooterComponent from '/src/Components/footer/footerComponent.vue';

export default {
    components: {
        SvgIcon,
        RouterLink,
        FooterComponent
    },
    data() {
        return {
            showDocumentation: true,
            instruction: instruction,
            icons: instruction["legenda"]["imgs"],

            info: instruction,
            iconsCondition: instruction['legenda']['iconsImgCondition'],
            iconsXYZ: instruction['legenda']['iconsXYZ'],
            iconsCircles: instruction['legenda']['iconsImgsCircle'],
            iconsDiamonds: instruction['legenda']['iconsImgsDiamond'],
            iconsIntensity: instruction['legenda']['iconsImgIntensity'],
            iconsArrows: instruction['legenda']['iconsImgArrows'],
            ingredientsBlue: instruction['legenda']['ingredients']['blueBox'],
            ingredientsGreen: instruction['legenda']['ingredients']['greenBox'],
            ingredientsYellow: instruction['legenda']['ingredients']['yellowBox'],
            ingredientsWhite: instruction['legenda']['ingredients']['whiteBox'],

            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
        };
    },
    mounted() {
        this.checkScrollability();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
        console.log(instruction)
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
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
