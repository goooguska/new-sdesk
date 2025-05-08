<script setup>
import BasePopup from './BasePopup.vue';

const props = defineProps({ item: Object });
const emit = defineEmits(['close', 'delete']);

const confirm = () => {
  emit('delete', props.item);
  emit('close');
};
</script>

<template>
  <BasePopup title="Подтверждение удаления" @close="$emit('close')">
    <p>
      Вы действительно хотите удалить
      <strong>«{{ item?.name || item?.title || `#${item.id}` }}»</strong>?
    </p>
    <div class="actions">
      <button class="btn btn-danger" @click="confirm">Удалить</button>
      <button class="btn btn-secondary" @click="$emit('close')">Отмена</button>
    </div>
  </BasePopup>
</template>

<style scoped>
.actions {
  margin-top: 20px;
  display: flex;
  gap: 10px;
  justify-content: flex-end;
}

.btn {
  padding: 8px 14px;
  font-size: 14px;
  border: none;
  cursor: pointer;
  border-radius: 6px;
  transition: background-color 0.2s ease;
}

.btn-danger {
  background-color: var(--error-color);
  color: var(--white);
}

.btn-secondary {
  background-color: var(--most-light-gray);
  color: var(--secondary-color);
}

.btn-danger:hover,
.btn-secondary:hover {
  background-color: rgba(0, 0, 0, 0.2);
}
</style>
