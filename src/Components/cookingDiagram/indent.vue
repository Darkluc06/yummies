<template>
  <div class="cookingDiagram__column">
    <figure class="cookingDiagram__line cookingDiagram__line--indent"></figure>
    <div class="cookingDiagram__lineWrapper">
      <div class="cookingDiagram__icon">
        <figure class="cookingDiagram__iconWrapper" @click="CompletedStep()">
          <img :src="image" :alt="imageAlt" class="cookingDiagram__img">
          <div class="cookingDiagram__completed" :class="finishedStep ? `cookingDiagram__completed--active` : ``">
            <SvgIcon :name="`check`" />
          </div>
        </figure>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import json from '/src/assets/json/data.json';
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';

export default {
  components: {
    SvgIcon,
    json,
  },
  data() {
    return {
      data: json.home,
      ingredientsString: '',
      popupActive: false,
      finishedStep: false,
    };
  },
  props: {
    image: {
      type: String,
      required: true,
    },
    imageAlt: {
      type: String,
    },
  },
  methods: {
    CompletedStep() {
      this.finishedStep = !this.finishedStep;
    },
  },
};
</script>
