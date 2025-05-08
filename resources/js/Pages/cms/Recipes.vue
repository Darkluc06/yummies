<script setup lang="ts">

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RecipeComponent from '@/Components/RecipeComponent.vue';
import { Recipe } from '@/interfaces/Recipe';

const props = defineProps<{
    recipes: Array<Recipe>
}>();
</script>

<template>
    <authenticated-layout>
        <h1>
            recipes
        </h1>
        <a href="/dashboard/recipes/create">
            Create
        </a>
        <ul v-for="recipe in recipes">
            <RecipeComponent :recipe="recipe" />
        </ul>
    </authenticated-layout>
</template>

<style scoped>

</style>
