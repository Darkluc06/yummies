<template>
    <div class="cookingDiagram__column">
        <div v-if="end === false">
            <figure class="cookingDiagram__line cookingDiagram__line--indent"></figure>
            <div class="cookingDiagram__lineWrapper--indent">
                <div class="cookingDiagram__icon">
                    <figure class="cookingDiagram__iconWrapper" @click="CompletedStep()">
                        <img :src="image" :alt="imageAlt" class="cookingDiagram__img">
                        <div class="cookingDiagram__completed" :class="finishedStep ? `cookingDiagram__completed--active` : ``">
                            <SvgIcon :name="`check`" />
                        </div>
                    </figure>
                </div>
                <div class="cookingDiagram__indentContainer">
                    <figure class="cookingDiagram__line cookingDiagram__line--rotate" />
                    <figure class="cookingDiagram__curve cookingDiagram__curve--RD" />
                </div>
            </div>
        </div>
        <div v-if="end === true">
            <figure class="cookingDiagram__line cookingDiagram__line--filler"/>
            <figure class="cookingDiagram__curve cookingDiagram__curve--DR" />
            <figure class="cookingDiagram__curve cookingDiagram__curve--LD" />
        </div>
    </div>
</template>

<script lang="ts">
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';

export default {
    components: {
        SvgIcon,
        finishedStep: false,
    },
    props: {
        image: {
            type: String,
            required: true,
        },
        imageAlt: {
            type: String,
        },
        end: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    methods: {
        CompletedStep() {
            this.finishedStep = !this.finishedStep;
        },
    },
};
</script>
