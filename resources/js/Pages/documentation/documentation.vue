<template>
    <div class="instruction">
        <article id="instruction_documentation" class="instruction_documentation" v-if="showDocumentation">
            <section class="instruction_documentation-top">
                <header class="instruction_documentation-header">
                    <h1 class="instruction_documentation-h1">Documentatie</h1>
                    <Link class="instruction_documentation-close" :href="`/`"><SvgIcon :name="`close`" /></Link>
                </header>
                <button class="instruction_documentation-button" @click="goToDocumentation">Documentatie</button>
                <button class="instruction_legenda-button" @click="goToLegenda">Legenda</button>
            </section>
            <section class="instructions_documentation-mid">
                <p class="instructions_documentation-p">
                it. Quae optio voluptates non et a ullam nam qui nihil aliquid fugit tempore expedita dolor nemo unde autem, tenetur nobis debitis deleniti.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae optio voluptates non et a ullam nam qui nihil aliquid fugit tempore expedita dolor nemo unde autem, tenetur nobis debitis deleniti.

                </p>
            </section>
        </article>
        <article id="instruction_legenda" class="instruction_legenda" v-else>
            <section class="instruction_legenda-top">
                <header class="instruction_legenda-header">
                    <h1 class="instruction_legenda-h1">Legenda</h1>
                    <Link class="instruction_legenda-close" :href="`/`"><SvgIcon :name="`close`" /></Link>
                </header>
                <button class="instruction_legenda-button" @click="goToDocumentation">Documentatie</button>
                <button class="instruction_legenda-button" @click="goToLegenda">Legenda</button>
            </section>
            <section class="instruction_legenda-mid">
                
            </section>
        </article>
    </div>
</template>

<script>
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        SvgIcon,
        Link
    },
    data() {
        return {
            showDocumentation: true,
        };
    },

    methods: {
        goToDocumentation() {
            this.showDocumentation = true;
        },
        goToLegenda() {
            this.showDocumentation = false;
        },
    },

};
</script>
