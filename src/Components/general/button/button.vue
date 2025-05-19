<template>
  <button :class="`button ${customClass}`" @click="onClick" v-if="!buttonLink">
    {{ text }}
    <SvgIcon v-if="icon" :name="icon" :size="30" :color="'currentColor'" :class="icon" />
  </button>
  <a v-if="buttonLink" :href="buttonLink" :class="`button ${customClass}`">
    {{ text }}
    <SvgIcon v-if="icon" :name="icon" :size="30" :color="'currentColor'" :class="icon" />
  </a>
</template>

<script>
import SvgIcon from '../icon/SvgIcon.vue';

export default {
  name: 'ButtonVue',
  components: {
    SvgIcon,
  },
  props: {
    text: {
      type: String,
      default: "",
      required: false,
    },
    onClick: {
      type: Function,
      required: false,
    },
    icon: {
      type: String,
      required: false,
    },
    customClass: {
      type: String,
      required: false,
    },
    buttonLink: {
      type: String
    },
  },
};
</script>
