<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({ modelValue: String })
const emit = defineEmits(['update:modelValue'])

const onInput = (e) => emit('update:modelValue', e.target.value)
</script>

<template>
  <input
      :value="modelValue"
      @input="onInput"
      type="text"
      placeholder="Поиск по названию"
      class="search-input"
  />
</template>

<style scoped>
.search-input {
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 33%;
  font-size: 14px;
}
</style>
