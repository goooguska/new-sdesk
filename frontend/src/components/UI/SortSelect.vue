<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  label: String,
  modelValue: String,
  options: {
    type: Array,
    default: () => [
      { label: 'По возрастанию', value: 'asc' },
      { label: 'По убыванию', value: 'desc' }
    ]
  }
})
const emit = defineEmits(['update:modelValue'])

const onChange = (e) => emit('update:modelValue', e.target.value || null)
</script>

<template>
  <div class="sort-select">
    <label class="sort-label">{{ label }}:</label>
    <select
        :value="modelValue"
        @change="onChange"
        class="sort-dropdown"
    >
      <option
          v-for="option in options"
          :key="option.value"
          :value="option.value"
      >
        {{ option.label }}
      </option>
    </select>
  </div>
</template>

<style scoped>
.sort-select {
  display: flex;
  align-items: center;
}

.sort-label {
  margin-right: 8px;
  font-size: 14px;
}

.sort-dropdown {
  padding: 6px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}
</style>
