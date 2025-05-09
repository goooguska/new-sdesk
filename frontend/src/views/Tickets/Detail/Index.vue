<script setup>

import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import {useUserStore} from "@/stores/userStore.js";
import {onMounted, ref} from "vue";
import {useTicketStore} from "@/stores/ticketStore.js";
import {useRoute} from "vue-router";
import BaseLoader from "@/components/BaseComponents/BaseLoader.vue";
import TicketInfo from "@/components/Ticket/Detail/TicketInfo.vue";
import TicketActions from "@/components/Ticket/Detail/TicketActions.vue";

const route = useRoute();
const id = ref(route.params.id)

const userStore = useUserStore();
const ticketStore = useTicketStore()

const userRole = ref(null)

onMounted(async () => {
  await ticketStore.getTicket(id.value);
  userRole.value = userStore.getUserRole()
})
</script>

<template>
<AuthenticatedLayout>
  <BaseLoader v-if="!ticketStore.state.selectedTicket || !userRole"/>
  <div v-else>
    <TicketInfo
      :ticket="ticketStore.state.selectedTicket"
      :user-role="userRole"
    />
    <textarea
        class="ticket-description"
        v-model="ticketStore.state.selectedTicket.data.description"
        rows="10"
        readonly
    ></textarea>
    <TicketActions
        :ticket="ticketStore.state.selectedTicket"
        :user-role="userRole"
    />
  </div>
</AuthenticatedLayout>
</template>

<style scoped>
.ticket-description {
  width: 100%;
  min-height: 200px;
  padding: 1rem;
  font-size: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  resize: vertical;
  box-sizing: border-box;
}
</style>