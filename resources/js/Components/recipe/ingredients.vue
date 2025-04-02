<template>
    <li class="ingredients__ingredient">
        <button class="ingredients__button">
            <SvgIcon  :name="`check`"/>
        </button>
        <p class="ingredients__name">1 kg Kruimige aardappelen</p>
    </li>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';

export default {
    components:{
        SvgIcon
    },
    props:{
        shwoImage: {
            type: Boolean,
            default: true
        }
    }
}

</script>