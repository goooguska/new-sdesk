<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
  type: String,
  required: true,
});

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
      class="focus:ring-indigo-500 rounded-sm border-light-gray shadow-sm focus:border-light-gray"
      v-model="model"
      ref="input"
  />
</template>
