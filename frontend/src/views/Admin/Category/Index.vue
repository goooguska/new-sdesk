<script setup>
import AdminList from "@/components/Admin/AdminList.vue";
import { useEntityData } from "@/composables/useEntityData.js";

const { items, loading } = useEntityData();
</script>

<template>
  <AdminList
      :items="items"
      :loading="loading"
  />
</template>
