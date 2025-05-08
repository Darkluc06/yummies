<template>
    <form @submit.prevent="updateIngredient">
        <input type="text" v-model="form.ingredient_name" name="ingredient_name" />
        <div>
            <label for="image_path">Image:</label>
            <img v-if="existingImageUrl" :src="`/storage/${existingImageUrl}`" alt="Current Image" style="max-width: 100px; max-height: 100px;">
            <input
                type="file"
                @change="handleFileChange"
                name="image_path"
                accept="image/*"
                id="image_path"
            />
            <small v-if="form.image_path">Selected file: {{ form.image_path.name }}</small>
        </div>
        <button type="submit">Update Ingredient</button>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps<{
    ingredient: {
        id: number;
        ingredient_name: string;
        image_path: string | null;
    };
}>();

const existingImageUrl = ref<string | null>(null);

const form = useForm<{
    ingredient_name: string;
    image_path: File | null;
}>({
    ingredient_name: props.ingredient.ingredient_name,
    image_path: null,
});

onMounted(() => {
    if (props.ingredient.image_path) {
        existingImageUrl.value = props.ingredient.image_path;
    }
});

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    form.image_path = target.files?.[0] ?? null;
};

const updateIngredient = () => {
    form.put(`/dashboard/ingredients/${props.ingredient.id}`, {
        onSuccess: () => {
            console.log('Ingredient updated successfully!');
        },
        onError: (errors) => {
            console.error('Update failed:', errors);
        },
    });
};
</script>
