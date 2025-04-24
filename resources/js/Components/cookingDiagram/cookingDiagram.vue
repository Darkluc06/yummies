<template>
  <section class="cookingDiagram">
    <div
      v-for="(row, rowIndex) in diagramData"
      :key="'row-' + rowIndex"
      class="cookingDiagram__row"
    >
      <component
        v-for="(item, itemIndex) in row"
        :key="'item-' + rowIndex + '-' + itemIndex"
        :is="item.type"
        v-bind="item"
      ></component>
    </div>
  </section>
</template>

<script>
import Tools from './tools.vue';
import Line from './line.vue';
import Ingredient from './ingredient.vue';
import Emty from './emty.vue';
import Forloop from './forloop.vue';
import jsonData from "../../../assets/json/data.json";

export default {
  components: {
    Tools,
    Line,
    Ingredient,
    Emty,
    Forloop
  },
  data() {
    return {
      diagramData: jsonData['cooking-diagram'].diagrams.diagram,
    };
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