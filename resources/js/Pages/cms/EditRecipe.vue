<template>
    <form @submit.prevent="updateRecipe" enctype="multipart/form-data">
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
            <img v-if="existingImageUrl" :src="`/storage/${existingImageUrl}`" alt="Current Image" style="max-width: 100px; max-height: 100px;">
            <input
                type="file"
                @change="handleFileChange"
                name="image_path"
                id="image_path"
                accept="image/jpeg,image/png,image/gif,image/avif"

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

        <button type="submit" class="btn btn-primary">Update Recipe</button>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps<{
    recipe: {
        id: number;
        recipe_name: string;
        image_path: string | null;
        description: string;
        recipe_duration: number;
        portions: number;
        food_category: string;
        keywords: string;
    };
}>();

const existingImageUrl = ref<string | null>(null);

const form = useForm<{
    recipe_name: string;
    image_path: File | null;
    description: string;
    recipe_duration: number;
    portions: number;
    food_category: string;
    keywords: string;
}>({
    recipe_name: props.recipe.recipe_name,
    image_path: null,
    description: props.recipe.description,
    recipe_duration: props.recipe.recipe_duration,
    portions: props.recipe.portions,
    food_category: props.recipe.food_category,
    keywords: props.recipe.food_category,
});

onMounted(() => {
    if (props.recipe.image_path) {
        existingImageUrl.value = props.recipe.image_path;
    }
});

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    form.image_path = target.files?.[0] ?? null;
    console.log(form)
};

const updateRecipe = () => {
    console.log(form);
    form.put(`/dashboard/recipes/${ props.recipe.id }`, {
        onSuccess: () => {
            console.log('Ingredient updated successfully!');
        },
        onError: (errors) => {
            console.error('Update failed:', errors);
        },
    });
};
</script>
