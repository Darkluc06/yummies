<script setup lang="ts">
    import { Ingredient } from '@/interfaces/Ingredient';
    const props = defineProps<{
        ingredient: Ingredient
    }>();

</script>

<template>
    <li>
        {{ ingredient }}
    </li>
</template>
