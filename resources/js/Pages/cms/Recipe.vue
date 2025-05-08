<script setup lang="ts">

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RecipeComponent from '@/Components/RecipeComponent.vue';
import { Recipe } from '@/interfaces/Recipe';

const props = defineProps<{
    recipe: Recipe
}>();
</script>

<template>
    <authenticated-layout>
        <h1>
            recipes
        </h1>
        <recipe-component :recipe="props.recipe"/>
    </authenticated-layout>
</template>

<style scoped>

</style>
