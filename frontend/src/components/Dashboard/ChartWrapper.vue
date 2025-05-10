<script setup>
import ChartInfo from './ChartInfo.vue';

defineProps({
  title: String,
  data: Object,
  labels: Array,
  values: Array,
  suffix: {
    type: String,
    default: 'шт.'
  }
});
</script>

<template>
  <div class="chart-block" v-if="!!data">
    <h2 class="subtitle">{{ title }}</h2>
    <slot />
    <ChartInfo :total="data.total" :labels="labels" :data="values" :suffix="suffix" />
  </div>
</template>

<style scoped>
.subtitle {
  font-size: 18px;
  color: var(--dark-green);
  font-weight: bold;
}
</style>
