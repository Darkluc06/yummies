<template>
    <section class="cookingDiagram">
        <div class="cookingDiagram__row">
            <Tools :tool="`pot`" />
            <Tools :tool="`pot`" />
            <Tools :tool="`pot`" />
            <Tools :tool="`pot`" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="true" />
        </div>
        <div class="cookingDiagram__row">
            <Ingredient :isString="false" :icon="`x`" :difficulty="3" />
        </div>
        <div class="cookingDiagram__row">
            <Line :active="true" :has-small-arrow="true" />
        </div>
    </section>
</template>

<script>

import Tools from './tools.vue'
import Line from './line.vue'
import Ingredient from './ingredient.vue';

export default {
    components:{
        Tools,
        Line,
        Ingredient
    }
}

</script>