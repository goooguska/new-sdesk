<script setup>
import { onMounted, ref, computed } from 'vue'
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue'
import { useTicketStore } from '@/stores/ticketStore.js'
import { useUserStore } from '@/stores/userStore.js'
import BaseLoader from '@/components/BaseComponents/BaseLoader.vue'
import TicketFilters from '@/components/Ticket/TicketFilters.vue'
import TicketTable from '@/components/Ticket/TicketTable.vue'

const ticketStore = useTicketStore()
const userStore = useUserStore()

const search = ref('')
const sortSettings = ref({
  status: null,
  created_at: null,
  category: null
})

onMounted(async () => {
  await ticketStore.getAll()
})

const resetFilters = () => {
  search.value = ''
  sortSettings.value = {
    status: null,
    created_at: null,
    category: null
  }
}

const filteredAndSortedTickets = computed(() => {
  let data = Array.isArray(ticketStore.state.tickets?.data)
      ? [...ticketStore.state.tickets.data]
      : []

  if (search.value) {
    data = data.filter(t =>
        t.title?.toLowerCase().includes(search.value.toLowerCase())
    )
  }

  data.sort((a, b) => {
    let result = 0

    if (sortSettings.value.status) {
      result = (a.status?.name || '').localeCompare(b.status?.name || '')
      if (result !== 0) return sortSettings.value.status === 'asc' ? result : -result
    }

    if (sortSettings.value.category) {
      result = (a.category?.name || '').localeCompare(b.category?.name || '')
      if (result !== 0) return sortSettings.value.category === 'asc' ? result : -result
    }

    if (sortSettings.value.created_at) {
      result = new Date(a.created_at) - new Date(b.created_at)
      if (result !== 0) return sortSettings.value.created_at === 'asc' ? result : -result
    }

    return result
  })

  return data
})
</script>

<template>
  <AuthenticatedLayout>
    <div v-if="ticketStore.state.isLoading">
      <BaseLoader />
    </div>
    <div v-else-if="ticketStore.state.errors.length">
      Ошибка: {{ ticketStore.state.errors }}
    </div>
    <div v-else>
      <TicketFilters
          :search="search"
          :sort-settings="sortSettings"
          @update:search="val => search = val"
          @update:sort-settings="val => sortSettings = val"
          @reset-filters="resetFilters"
      />

      <TicketTable
          :tickets="filteredAndSortedTickets"
          :user-role="userStore.getUserRole()"
      />
    </div>
  </AuthenticatedLayout>
</template>
