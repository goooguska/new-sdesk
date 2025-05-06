<script setup>
import AdminList from "@/components/Admin/AdminList.vue";
import { useEntityData } from "@/composables/useEntityData.js";

const { entity, items, loading } = useEntityData();
</script>

<template>
  <AdminList
      :title="entity?.name || 'Неизвестно'"
      :items="items"
      :loading="loading"
  />
</template>
