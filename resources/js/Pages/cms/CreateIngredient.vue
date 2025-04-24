<template>
  <form @submit.prevent="submitForm">
    <input type="text" v-model="form.ingredient_name" name="ingredient_name" />
    <input
        type="file"
        @change="handleFileChange"
        name="image_path"
        accept="image/*"
    />
    <button type="submit">Submit</button>
  </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

// Define the form with TypeScript types
const form = useForm<{
  ingredient_name: string;
  image_path: File | null;
}>({
  ingredient_name: '',
  image_path: null,
});

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  form.image_path = target.files?.[0] ?? null;
};

// Define the submit function
const submitForm = () => {
  form.post('/dashboard/ingredients', {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.error(errors);
    },
  });
};
</script>
