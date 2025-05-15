<template>
  <svg
      v-if="currentPath"
      :class="className"
      :width="size"
      :height="size"
      xmlns="http://www.w3.org/2000/svg"
      :viewBox="iconViewBox"
      :fill="color"
      :stroke="stroke"
      :stroke-width="strokeWidth"
  >
    <path :d="currentPath" />
  </svg>
</template>

<script>
import { computed } from 'vue';
import svgPaths from '@/assets/icons/icons.json';

export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    size: {
      type: [String, Number],
      default: '2.4rem',
    },
    color: {
      type: String,
      default: 'currentColor',
    },
    stroke: {
      type: String,
      default: 'none',
    },
    strokeWidth: {
      type: [String, Number],
      default: 'none',
    },
    className: {
      type: String,
      default: 'icon',
    },
  },
    setup(props) {
      const currentPath = computed(() => svgPaths[props.name]?.[0]?.path || null);
      const iconViewBox = computed(() => svgPaths[props.name]?.[0]?.viewbox || null);
      return { currentPath, iconViewBox };
    },
  };
</script>
