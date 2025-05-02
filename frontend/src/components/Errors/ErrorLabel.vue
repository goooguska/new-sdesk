<script setup>
defineProps({
  error: String,
});
</script>

<template>
    <p class="error-message"> {{error}} </p>
</template>

<style scoped>
.error-message {
  text-align: center;
  font-size: 14px;
  color: var(--error-color);
  margin-top: 5px;
  margin-bottom: 5px;
}

</style>