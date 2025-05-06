<template>
    <section class="cookingDiagram">
        <div v-for="(row, rowIndex) in diagramData" :key="'row-' + rowIndex" class="cookingDiagram__row">
            <!-- It takes into account to rerender the child element, so the ingredients will know they have to change when you press the + or - button -->
            <component v-for="(item, itemIndex) in row"
                :key="['item-' + rowIndex + '-' + itemIndex, JSON.stringify(nameOfRecipe.ingredients)]" :is="item.type"
                v-bind="item">
            </component>
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
    props: {
        nameOfRecipe: Object
    },
    components: {
        Tools,
        Line,
        Ingredient,
        Emty,
        Forloop
    },
    data() {
        let recipeDiagram = [];

        recipeDiagram = this.nameOfRecipe.diagram;

        if(recipeDiagram){
            return{
                diagramData: recipeDiagram,
            }
        }
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
