<script setup>
import BaseLoader from "@/components/BaseComponents/BaseLoader.vue";
import { defineProps } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  items: {
    type: Array,
    required: true,
  },
  loading: {
    type: Boolean,
    required: true,
  },
});
</script>

<template>
  <div v-if="loading">
    <BaseLoader />
  </div>
  <div v-else>
    <p class="title">{{ title }}</p>
    <ul>
      <li v-for="item in items" :key="item.id">
        {{ item.name ?? item.title }}
      </li>
    </ul>
  </div>
</template>

<style scoped>
</style>
