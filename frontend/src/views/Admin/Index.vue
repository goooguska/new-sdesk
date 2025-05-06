<script setup>

import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import LeftSidebar from "@/components/Admin/LeftSidebar.vue";
</script>

<template>
  <AuthenticatedLayout>
    <div class="admin">
      <LeftSidebar/>
      <div class="content">
        <RouterView />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.admin {
  display: flex;
}

.content {
  flex: 1;
  padding: 20px;
}
</style>