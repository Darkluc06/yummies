<template>
    <div class="modal" v-if="open === true">
        <section class="modal_modal">
            <header class="modal_header">
                <h2 class="modal_title">
                    {{ title }}
                </h2>
                <button class="modal_close" @click="modalClose"><SvgIcon :name="`close`" /></button>
            </header>
            <summary class="modal_summary">Deze legenda laat een overzicht zien van verschillende iconen, pijlen, kleuren en voorbeelden</summary>
            <ul class="modal_container-icons">
                <li class="modal_icons" v-for="(icon, index) in icons" :key="index">
                    <img class="modal_icon" :src="icon.src" alt="icon" />
                    <span class="modal_icon-label">{{ icon.label }}</span>
                </li>
            </ul>
        </section>
    </div>
</template>

<script>

import SvgIcon from '../general/icon/SvgIcon.vue';
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    title: {
      type: String,
      required: true
    },
    open: {
      type: Boolean,
      required: true,
      default: false
    }
  },
  data() {
  return {
    icons: [
      {
        src: new URL('../assets/cconditie.png', import.meta.url).href,
        label: 'Actie'
      },
      {
        src: new URL('../assets/rconditie.png', import.meta.url).href,
        label: 'Conditie'
      },
      {
        src: new URL('../assets/niet_x.png', import.meta.url).href,
        label: 'Niet X'
      },
      {
        src: new URL('../assets/x_en_y.png', import.meta.url).href,
        label: 'X en Y'
      },
      {
        src: new URL('../assets/x_of_y.png', import.meta.url).href,
        label: 'X of Y'
      },
      {
        src: new URL('../assets/x_of_y_z.png', import.meta.url).href,
        label: 'X of Z of Y'
      },
      {
        src: new URL('../assets/roeren.png', import.meta.url).href,
        label: 'Roeren'
      },
      {
        src: new URL('../assets/schillen.png', import.meta.url).href,
        label: 'Schillen'
      },
      {
        src: new URL('../assets/openen.png', import.meta.url).href,
        label: 'Openen'
      },
      {
        src: new URL('../assets/afscheuren.png', import.meta.url).href,
        label: 'Afsheuren'
      },
      {
        src: new URL('../assets/reepjes_snijden.png', import.meta.url).href,
        label: 'Reepjes snijden'
      },
      {
        src: new URL('../assets/reepjes_snijdenY.png', import.meta.url).href,
        label: 'Reepjes snijden'
      },
      {
        src: new URL('../assets/ringen_snijden.png', import.meta.url).href,
        label: 'Ringen snijden'
      },
    ]
  };
},
  methods: {
    modalClose() {
      this.$emit('close');
    }
  }
};


</script>
