<script setup>
import { defineProps, ref } from 'vue';
import BaseLoader from "@/components/BaseComponents/BaseLoader.vue";
import AdminListRow from "@/components/Admin/AdminListRow.vue";
import ViewPopup from "@/components/Admin/components/popups/ViewPopup.vue";
import EditPopup from "@/components/Admin/components/popups/EditPopup.vue";
import DeletePopup from "@/components/Admin/components/popups/DeletePopup.vue";
import {useAdminStore} from "@/stores/adminStore.js";
import {useEntityCrud} from "@/composables/useEntityCrud.js";
import CreatePopup from "@/components/Admin/components/popups/CreatePopup.vue";
import SaveButton from "@/components/Admin/components/UI/SaveButton.vue";

defineProps({
  items: Array,
  loading: Boolean,
});

const { createEntity, updateEntity, deleteEntity } = useEntityCrud();

const adminStore = useAdminStore()

const selectedItem = ref(null);
const show = ref({
  view: false,
  edit: false,
  delete: false,
  create: false
});

const openPopup = (type, item) => {
  if (item !== null) {
    selectedItem.value = item;
  }
  show.value[type] = true;
};

const handleCreate = async (data) => {
  await createEntity(data);
};

const handleEdit = async (data) => {
  await updateEntity(selectedItem.value.id, data);
};

const handleDelete = async () => {
  await deleteEntity(selectedItem.value.id);
};

</script>

<template>
  <div v-if="loading">
    <BaseLoader />
  </div>
  <div v-else>
    <SaveButton @click="openPopup('create', null)"> Создать новую сущность </SaveButton>
    <table class="table">
      <thead class="table-head">
      <tr>
        <th v-for="field in Object.keys(items[0] ?? {})" :key="field">
          {{ adminStore.adminFieldMap[field] ?? field }}
        </th>
        <th>Действия</th>
      </tr>
      </thead>
      <tbody class="table-body">
      <AdminListRow
          v-for="item in items"
          :key="item.id"
          :item="item"
          @view="openPopup('view', item)"
          @edit="openPopup('edit', item)"
          @delete="openPopup('delete', item)"
      />
      </tbody>
    </table>

    <ViewPopup v-if="show.view" :item="selectedItem" @close="show.view = false" />
    <EditPopup
        v-if="show.edit"
        :item="selectedItem"

        @close="show.edit = false"
        @edit="handleEdit($event)" />
    <DeletePopup v-if="show.delete" :item="selectedItem" @close="show.delete = false" @delete="handleDelete" />
    <CreatePopup v-if="show.create" @close="show.create = false" @create="handleCreate" />
  </div>
</template>

<style scoped>
.table {
  font-size: 14px;
  width: 100%;
  border-collapse: collapse;
  word-break: break-word;
}

.table-head {
  background-color: var(--most-light-gray);
  color: var(--dark-green);
}

th, td {
  text-align: left;
  padding: 12px 16px;
  border: 1px solid var(--light-gray);
  vertical-align: top;
}

th {
  font-weight: bold;
}

</style>
