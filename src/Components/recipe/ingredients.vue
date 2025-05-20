<template>
    <li class="ingredients__ingredient">
        <button :class="`ingredients__button ingredients__button--${checked}`" @click="checkBox">
            <SvgIcon :name="`check`"/>
        </button>
        <p class="ingredients__name">{{ Math.round(ingredient.amount * 100) / 100 }} {{ ingredient.unit }} {{ ingredient.name }}</p>        </li>
</template>
<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components:{
        SvgIcon
    },
    props: {
        ingredient: {
            type: Object,
            required: true
        }
    },
    data() {
        return{
            checked: false,
        }
    },
    methods: {
        checkBox(){
            this.checked = !this.checked;
        }
    }
}

</script>
