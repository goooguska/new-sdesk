<script setup>
import { computed, onMounted, reactive } from 'vue';
import BasePopup from './BasePopup.vue';
import SaveButton from "@/components/Admin/components/UI/SaveButton.vue";
import { useAdminStore } from "@/stores/adminStore.js";

const props = defineProps({ item: Object });
const emit = defineEmits(['close', 'edit']);

const adminStore = useAdminStore();
const editable = reactive({});

onMounted(async () => {
  const relationStores = [...new Set(Object.values(adminStore.relations))];
  await Promise.all(
      relationStores.map(relation => {
        if (adminStore[relation]?.length === 0) {
          return adminStore.getData(relation);
        }
      })
  );

  Object.assign(editable, prepareItem(props.item));
});

const prepareItem = (item) => {
  const prepared = { ...item };

  for (const [field] of Object.entries(adminStore.relations)) {
    if (item[field] && item[field].id !== undefined) {
      prepared[`${field}_id`] = item[field].id;
      delete prepared[field];
    }
  }

  return prepared;
};

const getFieldType = (key) => adminStore.fieldTypes[key] || 'default';

const isRelationField = (key) =>
    key.endsWith('_id') && adminStore.relations[key.replace('_id', '')];

const getRelationOptions = (key) => {
  const relationName = adminStore.relations[key.replace('_id', '')];
  return adminStore[relationName] || [];
};

const displayKeys = computed(() =>
    Object.keys(editable).filter(key => !adminStore.excludedFields.includes(key))
);
</script>

<template>
  <BasePopup :title="'Редактирование'" @close="$emit('close')">
    <form @submit.prevent="emit('edit', editable); emit('close')" class="edit-form">
      <template v-for="key in displayKeys" :key="key">
        <div class="form-group">
          <label>{{ adminStore.adminFieldMap[key.replace('_id', '')] || key }}</label>

          <select v-if="isRelationField(key)"
                  v-model="editable[key]"
                  class="relation-select">
            <option v-for="option in getRelationOptions(key)" :key="option.id" :value="option.id">
              {{ option.name || option.title }}
            </option>
          </select>

          <input v-else-if="getFieldType(key) === 'default'"
                 v-model="editable[key]"
                 type="text"
                 :placeholder="adminStore.adminFieldMap[key] || key" />

          <textarea v-else-if="getFieldType(key) === 'textarea'"
                    v-model="editable[key]"
                    :placeholder="adminStore.adminFieldMap[key] || key"
                    rows="4" />
        </div>
      </template>

      <SaveButton type="submit">Сохранить</SaveButton>
    </form>
  </BasePopup>
</template>

<style scoped>
.edit-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

label {
  font-weight: 600;
  margin-bottom: 6px;
}

input,
select,
textarea {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  transition: border 0.2s ease;
}

input:focus,
select:focus,
textarea:focus {
  border-color: var(--green);
  outline: none;
}
</style>
