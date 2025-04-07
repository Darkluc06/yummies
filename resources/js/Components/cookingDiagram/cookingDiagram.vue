<template>
    <section class="cookingDiagram">
        <div class="cookingDiagram__row">
            <tools :tool="`pot`" />
            <tools :tool="`pot`" />
            <tools :tool="`pot`" />
            <tools :tool="`pot`" />
        </div>
        <div class="cookingDiagram__row">
            <line :active="true" />
        </div>
    </section>
</template>

<script>

import tools from './tools.vue'
import line from './line.vue'

export default {
    components:{
        tools,
        line
    }
}

</script>