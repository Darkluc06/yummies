<template>
    <nav class="nav_container">
        <ul class="nav_ul">
            <li class="nav_links" @click="selectCategory('all')">
                <figure class="nav_icon  ">
                </figure>
                <h2> {{ cookingStyle.all }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Aziatisch')">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Aziatisch'"/>
                </figure>
                <h2> {{ cookingStyle.asian }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Italiaans')">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Italiaans'"/>
                </figure>
                <h2>{{ cookingStyle.italian }}</h2>
            </li>
            <li class="nav_links" @click="selectCategory('Fastfood')">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Fastfood'"/>
                </figure>
                <h2> {{ cookingStyle.fastfood }} </h2>
                <!-- <Link :href="route('Dashboard')"></Link> -->
            </li>
            <li class="nav_links" @click="selectCategory('Japans')">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Japans'"/>
                </figure>
                <h2> {{ cookingStyle.japanese }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Vegetarisch')">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Vegetarisch'"/>
                </figure>
                <h2> {{ cookingStyle.vegetarian }} </h2>
            </li>
        </ul>
        <div class="filtered-results">
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import json from './../../../assets/json/data.json';
import iconComponent from './../general/icon/icon.vue'

export default {
    components: {
        iconComponent
    },
    data() {
        return {
            cookingStyle: json.navigation,
            selectedCategory: null,
        }
    },
    methods: {
        selectCategory(category) {
            this.selectedCategory = category;
            this.$emit('categorySelected', category);
        }
    }
}
</script>
