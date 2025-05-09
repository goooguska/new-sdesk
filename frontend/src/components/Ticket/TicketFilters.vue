<script setup>
import { defineProps, defineEmits } from 'vue'
import SearchInput from "@/components/UI/SearchInput.vue";
import SortSelect from "@/components/UI/SortSelect.vue";

const props = defineProps({
  search: String,
  sortSettings: Object
})

const emit = defineEmits(['update:search', 'update:sort-settings', 'reset-filters'])

const updateSort = (key, value) => {
  emit('update:sort-settings', {
    ...props.sortSettings,
    [key]: value
  })
}
</script>

<template>
  <div class="filters">
    <SearchInput
        :model-value="search"
        @update:modelValue="emit('update:search', $event)"
    />

    <div class="sorts">
      <SortSelect
          label="Статус"
          :model-value="sortSettings.status"
          @update:modelValue="updateSort('status', $event)"
      />
      <SortSelect
          label="Дата"
          :model-value="sortSettings.created_at"
          @update:modelValue="updateSort('created_at', $event)"
      />
      <SortSelect
          label="Категория"
          :model-value="sortSettings.category"
          @update:modelValue="updateSort('category', $event)"
      />

      <button class="reset-button" @click="emit('reset-filters')">
        Сбросить фильтры
      </button>
    </div>
  </div>
</template>

<style scoped>
.filters {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.sorts {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.reset-button {
  font-size: 14px;
  color: var(--white);
  background-color: var(--green);
  padding: 8px 16px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s;
}

.reset-button:hover {
  background-color: var(--dark-green) ;
}
</style>
