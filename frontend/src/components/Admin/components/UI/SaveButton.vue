<script setup>

</script>

<template>
  <button class="btn">
    <slot/>
  </button>
</template>

<style scoped>
.btn {
  border: none;
  color: var(--white);
  font-weight: bold;
  padding: 12px;
  border-radius: 12px;
  background-color: var(--dark-green);
  margin-bottom: 1rem;
  cursor: pointer;
}
</style>