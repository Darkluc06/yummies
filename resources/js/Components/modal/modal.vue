<template>
    <div class="modal" v-if="open === true">
        <section class="modal__modal">
            <header class="modal__header">
                <h2 class="modal__title">
                    {{ title }}
                </h2>
                <button class="modal__close" @click="modalClose"><SvgIcon :name="`close`" /></button>
            </header>
            <ul class="modal__icons">
                <li class="modal__icon">
                    <span>
                        <SvgIcon :name="`burger`" />
                        Omschrijving van icoon
                    </span>
                </li>
            </ul>
        </section>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components:{
        SvgIcon,
        Link
    },
    props:{
        title:{
            type: String,
            required: true,
        },
        open:{
            type: Boolean,
            required: true,
            default: false
        }
    },
    methods:{
        modalClose(){
            this.$emit('close');
        }
    }
}

</script>