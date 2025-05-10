<script setup>
defineProps({
  total: Number,
  labels: Array,
  data: Array,
  suffix: {
    type: String,
    default: 'шт.',
  }
});
</script>

<template>
  <div class="chart-info">
    <p>Всего: {{ total }} шт.</p>
    <div
        v-for="(label, idx) in labels"
        :key="label"
        class="flex justify-between"
    >
      <span>{{ label }}:</span>
      <span>{{ data[idx] }} {{ suffix }}</span>
    </div>
  </div>
</template>

<style scoped>
.chart-info {
  margin: 0 auto;
}
</style>
