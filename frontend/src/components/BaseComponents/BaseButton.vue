<script setup>
defineProps({
  type: {
    type: String,
    default: 'text'
  },
});
</script>

<template>
  <button :type="type"> <slot/> </button>
</template>

<style scoped>
button {
  border-radius: 20px;
  color: var(--white);
  border: none;
  text-align: center;
  max-width: 100%;
  cursor: pointer;
}
</style>