<script setup>
import { defineProps } from 'vue';
import formatObject, { formatSimpleString} from "../../utils/formatObject.js";

defineProps({
  item: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <tr>
    <td v-for="(value, key) in item" :key="key">
      <span v-if="typeof value === 'object' && value !== null">
        {{ formatObject(value) }}
      </span>
      <span v-else>
        {{ formatSimpleString(value) }}
      </span>
    </td>
    <td>
      <button @click="$emit('view')">👁</button>
      <button @click="$emit('edit')">✏️</button>
      <button @click="$emit('delete')">🗑</button>
    </td>
  </tr>
</template>

<style scoped>
td {
  padding: 12px 16px;
  border: 1px solid #ddd;
  text-align: left;
  vertical-align: top;
}

button {
  margin: 0 4px;
  padding: 6px 10px;
  font-size: 14px;
  background: none;
  border: none;
  cursor: pointer;
  transition: transform 0.2s ease;
}
</style>
