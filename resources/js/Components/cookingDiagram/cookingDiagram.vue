<template>
    <section class="cookingDiagram">
        <div class="cookingDiagram__row ">
            <Tools :tool="`pot`" />
            <Tools :tool="`pot`" />
            <Tools :tool="`pot`" />
            <Tools :tool="`pot`" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="false" />
            <Line :active="false" />
            <Ingredient :is-string="true" :ingedient="`2L water`" :active="true" />
            <Line :active="false" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="false" />
            <Line :active="false" />
            <Ingredient :is-string="false" :icon="`twitter`" :difficulty="1"/>
            <Line :active="false" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="false" />
            <Line :active="false" />
            <Line :active="true" />
            <Line :active="true" :has-big-arrow="true" />
        </div>
        <div class="cookingDiagram__row">
            <Ingredient :is-string="true" :ingedient="`500g Meel, 1l melk, 2 eieren`" />
            <Line :active="false" />
            <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
            <Ingredient :is-string="false" :icon="`twitter`" :difficulty="5"/>
            <Line :active="false" />
            <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="true" />
            <Ingredient :is-string="false" :icon="`twitter`" :difficulty="3"/>
            <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="true" />
            <Ingredient :is-string="true" :ingedient="`Boter`" />
            <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="true" :end="true" />
            <Line :active="true" />
            <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Forloop :width="'2'" :steps="'8'" />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="0"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="5" :is-circle="false"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="0" :is-circle="false"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="0"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="0" :is-circle="false"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="0"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Ingredient :is-string="false" :icon="`twitter`" :difficulty="0" :is-circle="false" :has-backwards-arrow="true" :steps="`4`"/>
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Line :active="true" :end="true" />
          <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
          <Emty />
          <Emty />
          <Line :active="true" />
        </div>
    </section>
</template>

<script>
import Tools from './tools.vue';
import Line from './line.vue';
import Ingredient from './ingredient.vue';
import Emty from './emty.vue';
import Forloop from './forloop.vue';
 
export default {
  components: {
    Tools,
    Line,
    Ingredient,
    Emty,
    Forloop
  },
  mounted() {
    this.calculateColumns();
  },
  methods: {
    calculateColumns() {
      let rowElements = document.getElementsByClassName('cookingDiagram__row');
      for (let i = 0; i < rowElements.length; i++) {
        const childCount = rowElements[i].children.length;
        rowElements[i].classList.add(`columns--${childCount}`);
      }
    },
  },
};
</script>