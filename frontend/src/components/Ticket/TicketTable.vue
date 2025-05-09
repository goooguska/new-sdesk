<script setup>
import { defineProps } from 'vue'
import { formatDate } from "../../utils/formatDate.js";
import { useRouter } from 'vue-router'

const router = useRouter()
const props = defineProps({
  tickets: Array,
  userRole: String
})

const navigateToTicket = (id) => {
  router.push(`/tickets/${id}`)
}
</script>

<template>
  <table class="table">
    <thead class="table-head">
    <tr>
      <th>Заголовок</th>
      <th>Дата подачи</th>
      <th>Категория</th>
      <th v-if="userRole === 'user'">Ответственный</th>
      <th v-else>Сотрудник</th>
      <th>Статус</th>
    </tr>
    </thead>
    <tbody class="table-body">
    <tr
        v-for="ticket in tickets"
        :key="ticket.id"
        @click="navigateToTicket(ticket.id)"
        class="row-link"
    >
      <td>
        <span class="link">{{ ticket.title }}</span>
      </td>
      <td>{{ formatDate(ticket.created_at) }}</td>
      <td>{{ ticket.category?.name || '—' }}</td>
      <td v-if="userRole === 'user'">
        {{ ticket.assigned?.login || '—' }}
      </td>
      <td v-else>
        {{ ticket.creator?.login || '—' }}
      </td>
      <td>{{ ticket.status?.name || '—' }}</td>
    </tr>
    </tbody>
  </table>
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

.row-link {
  position: relative;
  cursor: pointer;
  transition: all 0.2s ease;
}

.row-link:hover {
  background-color: rgba(240, 253, 250, 0.5);
  transform: translateX(4px);
}

.row-link td:first-child {
  position: relative;
}

.link {
  color: var(--dark-green);
  font-weight: bold;
  position: relative;
}

.link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 1px;
  background-color: var(--dark-green);
  transition: width 0.3s ease;
}

.row-link:hover .link::after {
  width: 100%;
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

.row-link::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1;
}
</style>