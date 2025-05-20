<template>
    <section ref="cookingDiagram" class="cookingDiagram">
        <div v-for="(row, rowIndex) in diagramData" :key="'row-' + rowIndex" class="cookingDiagram__row">
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
import Empty from './empty.vue';
import Forloop from './forloop.vue';
import Arrow from './arrow.vue'
import Timeline from './timeline.vue';
import Indent from './indent.vue';

export default {
    props: {
        nameOfRecipe: Object
    },
    components: {
        Tools,
        Line,
        Ingredient,
        Empty,
        Forloop,
        Arrow,
        Timeline,
        Indent
    },
    data() {
        let recipeDiagram = [];

        recipeDiagram = this.nameOfRecipe.diagram;

        if (recipeDiagram) {
            return {
                diagramData: recipeDiagram,
                isDragging: false,
                startX: 0,
                scrollLeft: 0,
            }
        }
    },
    mounted() {
        this.calculateColumns();
        const diagram = this.$refs.cookingDiagram;

        diagram.addEventListener('mousedown', this.startDrag);
        diagram.addEventListener('mousemove', this.drag);
        diagram.addEventListener('mouseup', this.endDrag);
        diagram.addEventListener('mouseleave', this.endDrag);
    },
    beforeUnmount() {
        const diagram = this.$refs.cookingDiagram;
        diagram.removeEventListener('mousedown', this.startDrag);
        diagram.removeEventListener('mousemove', this.drag);
        diagram.removeEventListener('mouseup', this.endDrag);
        diagram.removeEventListener('mouseleave', this.endDrag);
    },
    methods: {
        calculateColumns() {
            let rowElements = document.getElementsByClassName('cookingDiagram__row');
            for (let i = 0; i < rowElements.length; i++) {
                const childCount = rowElements[i].children.length;
                rowElements[i].classList.add(`columns--${childCount}`);
            }
        },
        startDrag(e) {
            this.isDragging = true;
            this.startX = e.pageX - this.$refs.cookingDiagram.offsetLeft;
            this.scrollLeft = this.$refs.cookingDiagram.scrollLeft;
            this.$refs.cookingDiagram.style.cursor = 'grabbing';
        },
        drag(e) {
            if (!this.isDragging) return;
            const x = e.pageX - this.$refs.cookingDiagram.offsetLeft;
            const walk = (x - this.startX) * 1; // Adjust scroll speed if needed
            this.$refs.cookingDiagram.scrollLeft = this.scrollLeft - walk;
        },
        endDrag() {
            this.isDragging = false;
            this.$refs.cookingDiagram.style.cursor = 'grab';
        },
    },
};
</script>
