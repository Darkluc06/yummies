<template>
    <li class="ingredients__ingredient">
        <button :class="`ingredients__button ingredients__button--${checked}`" @click="checkBox">
            <SvgIcon  :name="`check`"/>
        </button>
        <p class="ingredients__name">1 kg Kruimige aardappelen</p>
    </li>
    <li class="ingredients__ingredient" v-if="shwoImage === true">
        
    </li>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components:{
        SvgIcon
    },
    data() {
        return{
            checked: false
        }
    },
    methods: {
        checkBox(){
            this.checked = !this.checked;
        }
    }
}

</script>