<template>
    <nav class="nav_container">
        <buttons class="scroll_button" @click="scrollNavigation(-200)">
            <svg class="scroll_button-svg" fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_92_" d="M111.213,165.004L250.607,25.607c5.858-5.858,5.858-15.355,0-21.213c-5.858-5.858-15.355-5.858-21.213,0.001 l-150,150.004C76.58,157.211,75,161.026,75,165.004c0,3.979,1.581,7.794,4.394,10.607l150,149.996 C232.322,328.536,236.161,330,240,330s7.678-1.464,10.607-4.394c5.858-5.858,5.858-15.355,0-21.213L111.213,165.004z"></path> </g></svg>
        </buttons>
        <ul class="nav_ul" ref="navigationList">
            <li class="nav_links" @click="selectCategory('all', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Alle'"/>
                </figure>
                <h2> {{ navigation.all }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Aziatisch', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Aziatisch'"/>
                </figure>
                <h2> {{ navigation.asian }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Italiaans', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Italiaans'"/>
                </figure>
                <h2>{{ navigation.italian }}</h2>
            </li>
            <li class="nav_links" @click="selectCategory('Fastfood', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Fastfood'"/>
                </figure>
                <h2> {{ navigation.fastfood }} </h2>
                </li>
            <li class="nav_links" @click="selectCategory('Japans', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Japans'"/>
                </figure>
                <h2> {{ navigation.japanese }} </h2>
            </li>
            <li class="nav_links" @click="selectCategory('Vegetarisch', $event)">
                <figure class="nav_icon  ">
                    <iconComponent :icon="'Vegetarisch'"/>
                </figure>
                <h2> {{ navigation.vegetarian }} </h2>
            </li>
        </ul>

        <div class="filtered-results">
        </div>
        <buttons class="scroll_button" @click="scrollNavigation(200)">
            <svg class="scroll_button-svg" fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve" transform="rotate(180)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_92_" d="M111.213,165.004L250.607,25.607c5.858-5.858,5.858-15.355,0-21.213c-5.858-5.858-15.355-5.858-21.213,0.001 l-150,150.004C76.58,157.211,75,161.026,75,165.004c0,3.979,1.581,7.794,4.394,10.607l150,149.996 C232.322,328.536,236.161,330,240,330s7.678-1.464,10.607-4.394c5.858-5.858,5.858-15.355,0-21.213L111.213,165.004z"></path> </g></svg>        
        </buttons>
    </nav>
</template>

<script>
import { RouterLink } from 'vue-router';
import navigation from '../../assets/json/navigation.json';
import iconComponent from './../general/icon/icon.vue'

export default {
    components: {
        iconComponent
    },
    data() {
        return {
            navigation: navigation,
            selectedCategory: null,
            clicked: false,
        }
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
        },
        scrollNavigation(scrollAmount) {
            this.$refs.navigationList.scrollLeft += scrollAmount;
        }
    }
}
</script>