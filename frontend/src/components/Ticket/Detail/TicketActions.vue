<script setup>
import CancelButton from "@/components/UI/CancelButton.vue";
import PrimaryButton from "@/components/UI/PrimaryButton.vue";
import FormSelect from "@/components/UI/FormSelect.vue";
import { useTicketStore } from "@/stores/ticketStore.js";
import { useStatusStore } from "@/stores/statusStore.js";
import { useRouter } from "vue-router";
import { computed, onMounted, ref } from "vue";

const props = defineProps({
  ticket: {
    type: Object,
    default: () => ({})
  },
  userRole: {
    type: String,
    default: () => 'user'
  }
});

const ticketStore = useTicketStore();
const statusStore = useStatusStore();
const router = useRouter();

const status = ref('');

onMounted(async () => {
  await statusStore.getAllStatuses();
});

const deleteTicket = async () => {
  await ticketStore.deleteTicket(props.ticket.data.id);
  await router.push('/');
};

const statusOptions = computed(() => {
  const currentStatusId = props.ticket.data.status.id;
  return [
    { value: '', text: 'Выбрать статус' },
    ...statusStore.statuses
        .filter(status => status.id !== currentStatusId)
        .map(status => ({
          value: status.id,
          text: status.name
        }))
  ];
});

const updateTicket = async () => {
  if (!status.value) return;

  try {
    await ticketStore.updateTicket(props.ticket.data.id, {
      status_id: status.value
    });
    await router.push('/');
  } catch (e) {
    console.error('Ошибка при обновлении статуса', e);
  }
};
</script>


<template>
  <div class="actions">
    <div class="user-actions" v-if="userRole === 'user'">
      <div class="buttons">
        <CancelButton @click="deleteTicket">Удалить заявку</CancelButton>
      </div>
    </div>

    <div class="manager-actions" v-else>
      <div class="select-action">
        <p class="current-status">
          Текущий статус:
          <span class="status-highlight">{{ ticket.data.status.name }}</span>
        </p>
          <FormSelect
              class="input-select"
              id="status_id"
              v-model="status"
              :options="statusOptions"
              :error="ticketStore.state.errors?.status_id?.[0]"
          />
      </div>

      <div class="buttons">
        <PrimaryButton @click="updateTicket">Сохранить</PrimaryButton>
      </div>
    </div>
  </div>
</template>

<style scoped>
.actions {
  margin-top: 20px;
}

.actions button {
  width: 220px;
  max-width: 100%;
}

.manager-actions {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 1.5rem;
}

.select-action {
  display: flex;
  width: 100%;
  align-items: center;
  gap: 20px;
}

.current-status {
  font-weight: 500;
  font-size: 1rem;
  margin-top: 0.5rem;
}

.status-highlight {
  background-color: var(--white);
  color: var(--green);
  padding: 0.25rem 0.5rem;
  font-weight: bold;
}

.input-select {
  max-width: 300px;
}

.buttons {
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}
</style>
