<template>
    <article class="yummies">
        <DesktopNavigation :title="home.title" />
        <header class="yummies_header">
            <div class="yummies_header-content">
                <h1 class="yummies_header-h1"> {{ home.title }} </h1>
                <label class="yummies_span">
                    <SvgIcon :name="`search`" />
                    <input v-model="searchTerm" @input="generateSuggestions" @keyup.enter="performSearch" type="text"
                        placeholder="Zoek recepten" class="yummies_input" ref="searchFieldMobile" id="yummies-input-mobile" />
                    <ul v-if="suggestions.length > 0" class="search-suggestions">
                        <li v-for="suggestion in suggestions" :key="suggestion.urlName"
                            @click="selectSuggestion(suggestion)" class="search-suggestion-item">
                            {{ suggestion.name }}
                        </li>
                    </ul>
                </label>
            </div>
            <div class="yummies_navigation">
                <Navigation @categorySelected="setSelectedCategory" />
            </div>
        </header>
        <main class="yummies_main">
            <section class="yummies_recipes">
                <div class="yummies__desktop--wrapper">
                    <label class="yummies__desktop--search yummies_span">
                        <SvgIcon :name="`search`" />
                        <input v-model="searchTerm" @input="generateSuggestions" @keyup.enter="performSearch"
                            type="text" placeholder="Zoek recepten" class="yummies_input" ref="searchFieldDesktop"
                            id="yummies-input-desktop" />
                        <ul v-if="suggestions.length > 0" class="search-suggestions search-suggestions--desktop">
                            <li v-for="suggestion in suggestions" :key="suggestion.urlName"
                                @click="selectSuggestion(suggestion)" class="search-suggestion-item">
                                {{ suggestion.name }}
                            </li>
                        </ul>
                    </label>
                    <Navigation @categorySelected="setSelectedCategory" />
                </div>
                <h1 class="yummies_recipes-h1"> {{ home.sectionRecipeH2 }} </h1>
                <ul class="yummies_recipes-container">
                    <Recipe v-for="recipe in filteredRecipes" :key="recipe.urlName || recipe.id" :recipe="recipe" />
                </ul>
            </section>
        </main>
        <FooterComponent :class="{ hidden: !footerVisible }" />
    </article>
    </template>

<script>
import Navigation from '@/Components/navigation/navigation.vue';
import Recipe from '@/Components/recipe/recipe.vue';
import home from '../assets/json/home.json';
import json from '../assets/json/recipe.json';
import SvgIcon from '@/Components/general/icon/SvgIcon.vue';
import DesktopNavigation from '@/Components/navigation/desktopNavigation.vue';
import FooterComponent from '../Components/footer/footerComponent.vue';

export default {
    name: 'HomePage',
    components: {
        Navigation,
        Recipe,
        SvgIcon,
        DesktopNavigation,
        FooterComponent
    },
    data() {
        return {
            home: home,
            data: json.recipePage,
            selectedCategory: null,
            isScrollable: false,
            footerVisible: true,
            isScrolling: false,
            scrollTimeout: null,
            searchTerm: '',
            suggestions: [],
        };
    },
    computed: {
       filteredRecipes() {
            const searchTermLower = this.searchTerm.toLowerCase();

            if (!this.data?.recipes) {
                console.warn("Recipe data (data.recipes) is missing in Home.vue");
                return [];
            }

            return this.data.recipes.filter(recipe => {
                const categoryMatch = !this.selectedCategory || this.selectedCategory === 'all' || recipe.type === this.selectedCategory;
                if (!categoryMatch) return false;
                if (!searchTermLower) return true;
                const nameMatch = recipe.name?.toLowerCase().includes(searchTermLower);
                const typeMatch = recipe.type?.toLowerCase().includes(searchTermLower);
                const descriptionMatch = recipe.description?.toLowerCase().includes(searchTermLower);
                const ingredientsMatch = recipe.ingredients?.some(ing => ing.name?.toLowerCase().includes(searchTermLower));
                const keywordsMatch = recipe.keywords?.some(keyword => keyword?.toLowerCase().includes(searchTermLower));

                return nameMatch || typeMatch || descriptionMatch || ingredientsMatch || keywordsMatch;
            });
        }
    },
    mounted() {
        this.checkScrollability();
        window.addEventListener('resize', this.checkScrollability);
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScrollability);
        window.removeEventListener('scroll', this.handleScroll);
        if (this.scrollTimeout) {
            clearTimeout(this.scrollTimeout);
        }
    },
    methods: {
        setSelectedCategory(category) {
            this.selectedCategory = category;
            this.searchTerm = '';
            this.suggestions = [];
        },
         // Checkt if the footer needs to be visible on the page
         checkScrollability() {
            this.isScrollable = document.body.scrollHeight > document.body.clientHeight;
            if (!this.isScrollable && !this.isScrolling) {
                this.footerVisible = true;
            } else {
                this.footerVisible = false;
            }
        },
        handleScroll() {
            this.footerVisible = false;
            this.isScrolling = true;
            clearTimeout(this.scrollTimeout);
            this.scrollTimeout = setTimeout(() => {
                this.isScrolling = false;
                this.checkScrollability();
            }, 100);
        },
        generateSuggestions() {
             const searchTermLower = this.searchTerm.toLowerCase();
            if (!searchTermLower) {
                this.suggestions = [];
                return;
            }
             if (!this.data?.recipes) {
                 this.suggestions = [];
                 return;
             }
             this.suggestions = this.data.recipes.filter(recipe => {
                    const categoryMatch = !this.selectedCategory || this.selectedCategory === 'all' || recipe.type === this.selectedCategory;
                    if(!categoryMatch) return false;

                    return (
                        recipe.name?.toLowerCase().includes(searchTermLower) ||
                        recipe.type?.toLowerCase().includes(searchTermLower) ||
                        recipe.description?.toLowerCase().includes(searchTermLower) ||
                        recipe.ingredients?.some(ing => ing.name?.toLowerCase().includes(searchTermLower)) ||
                        recipe.keywords?.some(keyword => keyword?.toLowerCase().includes(searchTermLower))
                    );
                })
                .slice(0, 5);
        },
        performSearch() {
            this.suggestions = [];
        },
        selectSuggestion(suggestion) {
            this.searchTerm = suggestion.name;
            this.suggestions = [];
        }
    }
};
</script>