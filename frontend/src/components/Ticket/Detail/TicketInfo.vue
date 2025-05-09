<script setup>
import {formatDate} from "@/utils/formatDate.js";

defineProps({
  ticket: {
    type: Object,
    default: () => ({})
  },
  userRole: {
    type: String,
    default: () => 'user'
  }
});

</script>

<template>
  <ul class="list">
    <li class="list-item">Номер:
      <span class="item-highlight">
        Заявка № {{ticket.data.id}}
      </span>
    </li>
    <li class="list-item">Тема:
      <span class="item-highlight">
        {{ticket.data.title}}
      </span>
    </li>
    <li class="list-item">Категория:
      <span class="item-highlight">
        {{ticket.data.category.name}}
      </span>
    </li>
    <li v-if="userRole === 'user'" class="list-item">Ответственный:
      <span class="item-highlight">
        {{ticket.data.assigned.name}} {{ticket.data.assigned.surname}}
      </span>
    </li>
    <li v-else class="list-item">Сотрудник:
      <span class="item-highlight">
        {{ticket.data.assigned.name}} {{ticket.data.assigned.surname}}
      </span>
    </li>
    <li class="list-item">Дата подачи:
      <span class="item-highlight">
        {{formatDate(ticket.data.created_at)}}
      </span>
    </li>
  </ul>
</template>

<style scoped>
.list {
  font-size: 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-bottom: 20px;
}

.list-item {
  color: var(--gray);
}

.item-highlight {
  color: var(--secondary-color);
}
</style>