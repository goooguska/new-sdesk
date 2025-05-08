<script setup>
import {ref, onMounted, computed} from 'vue';

const props = defineProps({
  message: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: 'success',
  },
});

const visible = ref(true);

const popupClass = computed(() => {
  return {
    'popup-success': props.type === 'success',
    'popup-error': props.type === 'error',
  };
});

const closePopup = () => {
  visible.value = false;
};

onMounted(() => {
  setTimeout(() => {
    visible.value = false;
  }, 3000);
});
</script>

<template>
  <Transition name="fade">
    <div v-if="visible" :class="['popup', popupClass]">
      <p>{{ message }}</p>
      <button @click="closePopup">✖</button>
    </div>
  </Transition>
</template>


<style scoped>
.popup {
  display: flex;
  align-items: center;
  gap: 10px;
  position: fixed;
  top: 15%;
  left: 50%;
  transform: translateX(-50%);
  padding: 20px 30px;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
  z-index: 1000;
  text-align: center;
}

.popup-success {
  background: var(--green);
  color: var(--white);
}

.popup-error {
  background: var(--red);
  color: var(--white);
}

.popup button {
  background: transparent;
  color: var(--white);
  border: none;
  font-size: 16px;
  cursor: pointer;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
