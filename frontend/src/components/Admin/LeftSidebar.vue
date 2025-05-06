<script setup>

import {useAdminStore} from "@/stores/adminStore.js";

const adminStore = useAdminStore()

</script>

<template>
  <div class="sidebar">
    <ul class="list">
      <li v-for="entity in adminStore.adminEntities" :key="entity.code">
        <RouterLink class="link" active-class="active-link" :to="'/admin/' + entity.code">{{ entity.name }}</RouterLink>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.sidebar {
  width: 250px;
  padding: 20px;
}

.list {
  display: flex;
  flex-direction: column;
  gap: 50px;
}

.link {
  font-size: 22px;
  color: var(--primary-color);
  font-weight: bold;
}

.link:hover {
  border-bottom: 3px solid var(--primary-color);
}

.active-link {
  border-bottom: 3px solid var(--primary-color);
}
</style>