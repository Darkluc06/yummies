<script setup lang="ts">

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Ingredient } from '@/interfaces/Ingredient';
import IngredientComponent from '@/Components/IngredientComponent.vue';

const props = defineProps<{
  ingredients: Ingredient
}>()

console.log(props.ingredients[0].id)

</script>

<template>
  <authenticated-layout>
    <h1>
    </h1>

    <ul v-for="ingredient in ingredients">
      <IngredientComponent :ingredient="ingredient" />
    </ul>

  </authenticated-layout>
</template>

