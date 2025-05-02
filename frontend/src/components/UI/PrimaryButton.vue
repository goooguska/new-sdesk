<script setup>

import BaseButton from "@/components/BaseComponents/BaseButton.vue";

defineProps({
  type: {
    type: String,
    default: 'button'
  },
});
</script>

<template>
  <BaseButton class="btn" :type="type"> <slot/> </BaseButton>
</template>

<style scoped>
.btn {
  background-color: var(--green);
  padding: 18px;
  font-size: 18px;
  font-weight: bold;
}
</style>