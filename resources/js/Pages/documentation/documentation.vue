<template>
    <div class="instruction">
        <article id="instruction_documentation" class="instruction_documentation" v-if="showDocumentation">
            <section class="instruction_documentation-top">
                <header class="instruction_documentation-header">
                    <h1 class="instruction_documentation-h1"> {{ instruction.documentation.title }} </h1>
                    <Link class="instruction_documentation-close" :href="`/`">
                    <SvgIcon :name="`close`" />
                    </Link>
                </header>
                <button class="instruction_documentation-button" @click="goToDocumentation"> {{ instruction.buttons['button-documentation'] }} </button>
                <button class="instruction_legenda-button" @click="goToLegenda"> {{ instruction.buttons["button-legenda"] }} </button>
            </section>
            <section class="instructions_documentation-mid">
                <p class="instructions_documentation-p">
                    {{ instruction.documentation.paragraph  }}
                </p>
            </section>
        </article>
        <article id="instruction_legenda" class="instruction_legenda" v-else>
            <section class="instruction_legenda-top">
                <header class="instruction_legenda-header">
                    <h1 class="instruction_legenda-h1"> {{ instruction.legenda.title }} </h1>
                    <Link class="instruction_legenda-close" :href="`/`">
                    <SvgIcon :name="`close`" />
                    </Link>
                </header>
                <button class="instruction_legenda-button" @click="goToDocumentation"> {{ instruction.buttons['button-documentation'] }} </button>
                <button class="instruction_legenda-button" @click="goToLegenda"> {{ instruction.buttons["button-legenda"] }} </button>
            </section>
            <section class="instruction_legenda-mid">
                <summary class="instruction_legenda-summary"> {{ instruction.legenda.summary }} </summary>
                <ul class="instruction_legenda-container">
                    <li class="instruction_legenda-icons" v-for="(iconImg, index) in icons" :key="index" v-if="icons">
                        <img class="instruction_legenda-img" :src="getImgUrl(iconImg.src)" :alt="iconImg.alt" />
                        <span class="instruction_legenda-label">{{ iconImg.label }}</span>
                    </li>
                </ul>
            </section>
        </article>
    </div>
</template>

<script>
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';
import json from './../../../../resources/assets/jason/data.json';

export default {
    components: {
        SvgIcon,
        Link
    },
    data() {
        return {
            showDocumentation: true,
            instruction: json["instruction"],
            icons: json["instruction"]["legenda"]["imgs"],
        };
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
        }
    },

};
</script>
