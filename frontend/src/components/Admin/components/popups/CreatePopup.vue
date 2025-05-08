<script setup>
import {computed, onMounted, reactive} from 'vue';
import BasePopup from './BasePopup.vue';
import SaveButton from "@/components/Admin/components/UI/SaveButton.vue";
import { useAdminStore } from "@/stores/adminStore.js";
import { useRoute } from 'vue-router';
const route = useRoute();

const entityCode = computed(() => route.name);

const emit = defineEmits(['close', 'create']);
const adminStore = useAdminStore();

const editable = reactive({});

onMounted(async () => {
  const fields = adminStore.fieldsForCreate?.[entityCode.value] ?? [];

  await Promise.all(fields.map(async (field) => {
    if (field.endsWith('_id')) {
      const relationKey = field.replace('_id', '');
      const storeKey = adminStore.relations[relationKey];
      if (storeKey && adminStore[storeKey].length === 0) {
        await adminStore.getData(storeKey);
      }
    }
    editable[field] = '';
  }));
});

const isRelationField = (key) =>
    key.endsWith('_id') && adminStore.relations[key.replace('_id', '')];

const getRelationOptions = (key) => {
  const relationName = adminStore.relations[key.replace('_id', '')];
  return adminStore[relationName] || [];
};

const getFieldType = (key) => {
  return adminStore.fieldTypes?.[key] || 'default';
};

const fieldLabel = (key) =>
    adminStore.adminFieldMap?.[key.replace('_id', '')] || key;

</script>

<template>
  <BasePopup :title="'Создание новой сущности'" @close="$emit('close')">
    <form @submit.prevent="emit('create', editable); emit('close')" class="edit-form">
      <div v-for="(value, key) in editable" :key="key" class="form-group">
        <label>{{ fieldLabel(key) }}</label>

        <select v-if="isRelationField(key)" v-model="editable[key]">
          <option v-for="option in getRelationOptions(key)" :key="option.id" :value="option.id">
            {{ option.name || option.title }}
          </option>
        </select>

        <textarea
            v-else-if="getFieldType(key) === 'textarea'"
            v-model="editable[key]"
            :placeholder="fieldLabel(key)"
            rows="4"
        />

        <input
            v-else
            type="text"
            v-model="editable[key]"
            :placeholder="fieldLabel(key)"
        />
      </div>

      <SaveButton type="submit">Создать</SaveButton>
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
}

input:focus,
select:focus,
textarea:focus {
  border-color: var(--green);
  outline: none;
}
</style>
