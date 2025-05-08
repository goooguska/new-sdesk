<script setup>
defineProps({ title: String });
</script>

<template>
  <div class="popup-overlay" @click.self="$emit('close')">
    <div class="popup-content">
      <div class="head">
        <h3>{{ title }}</h3>
        <button class="close" @click="$emit('close')">✖</button>
      </div>
      <div class="popup-body">
        <slot />
      </div>
    </div>
  </div>
</template>

<style scoped>
.popup-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-content {
  background: var(--white);
  padding: 30px;
  border-radius: 12px;
  min-width: 400px;
  max-height: 80vh;
  overflow-y: auto;
}

.head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.close {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
}
</style>
