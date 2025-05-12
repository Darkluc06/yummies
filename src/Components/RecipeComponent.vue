<script setup lang="ts">
    import { Recipe } from '@/interfaces/Recipe';
    const props = defineProps<{
        recipe: Recipe
    }>();

</script>

<template>
    <li>
        {{ recipe }}
        <a :href="`/dashboard/recipes/${recipe.id}/edit`">Update</a>
    </li>

</template>
