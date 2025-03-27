<template>
    <h2 class="recipe__headTitle">Recepten</h2>
    <ul class="recipe">
        <recipe />
        <recipe />
    </ul>
</template>


<script>

import recipe from '@/Components/recipe/recipe.vue';

export default {
    components:{
        recipe
    }
}

</script>