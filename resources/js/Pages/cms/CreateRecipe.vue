<template>
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
        <!-- Recipe Name -->
        <div class="form-group">
            <label for="recipe_name">Recipe Name *</label>
            <input
                type="text"
                v-model="form.recipe_name"
                name="recipe_name"
                id="recipe_name"
                class="form-control"
                required
            />
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea
                v-model="form.description"
                name="description"
                id="description"
                class="form-control"
                required
            ></textarea>
        </div>

        <!-- Image Upload -->
        <div class="form-group">
            <label for="image_path">Image *</label>
            <input
                type="file"
                @change="handleFileChange"
                name="image_path"
                id="image_path"
                accept="image/jpeg,image/png,image/gif,image/avif"
                required
                class="form-control"
            />

        </div>

        <!-- Recipe Duration -->
        <div class="form-group">
            <label for="recipe_duration">Duration (minutes) *</label>
            <input
                type="number"
                v-model.number="form.recipe_duration"
                name="recipe_duration"
                id="recipe_duration"
                class="form-control"
                required
                min="1"
            />
        </div>

        <!-- Portions -->
        <div class="form-group">
            <label for="portions">Portions *</label>
            <input
                type="number"
                v-model.number="form.portions"
                name="portions"
                id="portions"
                class="form-control"
                required
                min="1"
            />
        </div>

        <!-- Food Category -->
        <div class="form-group">
            <label for="food_category">Food Category *</label>
            <select
                v-model="form.food_category"
                name="food_category"
                id="food_category"
                class="form-control"
                required
            >
                <option value="" disabled>Select a category</option>
                <option value="Aziatisch">Aziatisch</option>
                <option value="Italiaans">Italiaans</option>
                <option value="Fastfood">Fastfood</option>
                <option value="Japans">Japans</option>
                <option value="vegetarisch">vegetarisch</option>
                <!-- Add more categories as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="description">Keywords *</label>
            <textarea
                v-model="form.keywords"
                name="keywords"
                id="keywords"
                class="form-control"
                required
            ></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Recipe</button>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

// Define the form with TypeScript types
const form = useForm<{
    recipe_name: string;
    image_path: File | null;
    description: string;
    recipe_duration: number;
    portions: number;
    food_category: string;
    keywords: string;
}>({
    recipe_name: '',
    image_path: null,
    description: '',
    recipe_duration: 0,
    portions: 1,
    food_category: '',
    keywords: '',
});

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    form.image_path = target.files?.[0] ?? null;
};

// Define the submit function
const submitForm = () => {
    form.post('/dashboard/recipes', {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
};
</script>
