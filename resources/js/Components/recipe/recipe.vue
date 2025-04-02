<template>
    <li class="recipe__item">
        <Link :href="`/recipe`" class="recipe__link">
            <imageComponent
                :figureClass="`recipe__figure`"
                :imageClass="`recipe__img`"
                :imageSource="`https://placehold.co/800x300`"
                :imageAlt="`test`"
            />
            <section class="recipe__text">
                <figure class="recipe__type">
                    <SvgIcon :name="`burger`" />
                </figure>
                <h3 class="recipe__title">Test</h3>
                <ul class="recipe__icons">
                    <li class="recipe__icon">
                        <span class="recipe__span">
                            8 <SvgIcon :name="`heart`"/>
                        </span>
                    </li>
                    <li class="recipe__icon">
                        <span class="recipe__span">
                            3 <SvgIcon :name="`person`"/>
                        </span>
                    </li>
                    <li class="recipe__icon">
                        <span class="recipe__span">
                            15 min <SvgIcon :name="`timer`"/>
                        </span>
                    </li>
                </ul>
                <p class="recipe__paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum optio, vel distinctio itaque nihil fuga molestias voluptas temporibus architecto illum labore earum, dicta voluptate facere animi sint quia? Quod, excepturi.</p>
            </section>
        </Link>
    </li>
</template>

<script>

import imageComponent from '../general/image/imageComponent.vue';
import SvgIcon from '../general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: "recipeList",
    components:{
        imageComponent,
        SvgIcon,
        Link
    }
}

</script>