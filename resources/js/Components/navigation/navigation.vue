<template>
    <nav class="nav_container">
        <ul class="nav_ul">
            <li class="nav_links" @click="selectCategory('all', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Alle'"/>
                </figure>
                <h2> {{ cookingStyle.all }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Aziatisch', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Aziatisch'"/>
                </figure>
                <h2> {{ cookingStyle.asian }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Italiaans', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Italiaans'"/>
                </figure>
                <h2>{{ cookingStyle.italian }}</h2>
            </li>
            <li class="nav_links" @click="selectCategory('Fastfood', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Fastfood'"/>
                </figure>
                <h2> {{ cookingStyle.fastfood }} </h2>
                <!-- <Link :href="route('Dashboard')"></Link> -->
            </li>
            <li class="nav_links" @click="selectCategory('Japans', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Japans'"/>
                </figure>
                <h2> {{ cookingStyle.japanese }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Vegetarisch', $event)">
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
            clicked: false,
        }
    },
    mounted() {

    },
    methods: {
        selectCategory(category, event) {
        this.selectedCategory = category;
        this.$emit('categorySelected', category);

        // Gives the nav-link an underline if it is active or not
        let navLinks = document.getElementsByClassName("nav_links");
        for (let i = 0; i < navLinks.length; i++) {
            navLinks[i].classList.remove('active');
        }

        event.currentTarget.classList.add('active');
    }
    }
}
</script>
