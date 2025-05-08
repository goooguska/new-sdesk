<script setup>
import { ref, computed, onMounted } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import { useAdminStore } from "@/stores/adminStore.js";
import { useTicketStore } from "@/stores/ticketStore.js";
import FormInput from "@/components/UI/FormInput.vue";
import FormSelect from "@/components/UI/FormSelect.vue";
import FormTextarea from "@/components/UI/FormTextarea.vue";
import PrimaryButton from "@/components/UI/PrimaryButton.vue";
import PopupMessage from "@/components/UI/PopupMessage.vue";
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";

const auth = useAuthStore();
const adminStore = useAdminStore();
const ticketStore = useTicketStore();

const form = ref({
  title: '',
  assigned_id: null,
  category_id: null,
  description: '',
  creator_id: auth.state.user.id
});

const managers = ref([]);
const showSuccess = ref(false);
const message = ref('');
const messageType = ref('success');

onMounted(async () => {
  await adminStore.getData('users');
  await adminStore.getData('categories');

  managers.value = adminStore.users.filter(user => user.role?.code === 'manager');
});

const categoryOptions = computed(() => {
  return [
    { value: '', text: 'Выберите категорию' },
    ...adminStore.categories.map(category => ({
      value: category.id,
      text: category.name
    }))
  ];
});

const managerOptions = computed(() => {
  return [
    { value: '', text: 'Назначить менеджера' },
    ...managers.value.map(manager => ({
      value: manager.id,
      text: manager.name
    }))
  ];
});

const submit = async () => {
  showSuccess.value = false;

  const success = await ticketStore.createTicket(form.value);

  if (success) {
    message.value = 'Заявка успешно создана!';
    messageType.value = 'success';
  } else {
    message.value = 'Произошла ошибка при создании заявки!';
    messageType.value = 'error';
  }

  showSuccess.value = true;

  form.value = {
    title: '',
    assigned_id: null,
    category_id: null,
    description: '',
    creator_id: auth.state.user.id
  };
};
</script>

<template>
  <AuthenticatedLayout>
    <form class="form-create" @submit.prevent="submit">
      <div class="form-grid">
        <div class="form-group">
          <label for="title">Тема:</label>
          <FormInput id="title" v-model="form.title" :error="ticketStore.state.errors?.title?.[0]" />
        </div>

        <div class="form-group">
          <label for="assigned">Кому:</label>
          <FormSelect
              id="assigned"
              v-model="form.assigned_id"
              :options="managerOptions"
              :error="ticketStore.state.errors?.assigned_id?.[0]"
          />
        </div>

        <div class="form-group">
          <label for="category">Категория:</label>
          <FormSelect
              id="category"
              v-model="form.category_id"
              :options="categoryOptions"
              :error="ticketStore.state.errors?.category_id?.[0]"
          />
        </div>
      </div>

      <div class="form-textarea">
        <label for="description">Текст заявки</label>
        <FormTextarea
            id="description"
            v-model="form.description"
            :error="ticketStore.state.errors?.description?.[0]"
        />
      </div>

      <div class="form-button">
        <PrimaryButton type="submit">Отправить</PrimaryButton>
      </div>
    </form>

    <PopupMessage
        v-if="showSuccess"
        :message="message"
        :type="messageType"
    />
  </AuthenticatedLayout>
</template>

<style scoped>
.form-grid {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
}

.form-group {
  display: flex;
  flex-direction: column;
  font-size: 14px;
}

.form-group:first-child {
  flex: 2;
}

.form-group:nth-child(2),
.form-group:nth-child(3) {
  flex: 1.5;
}

label {
  margin-bottom: 8px;
  font-weight: bold;
}

.form-textarea {
  margin-bottom: 30px;
}

.form-button {
  text-align: right;
}

.form-button button {
  padding: 12px 32px;
  min-width: 300px;
}

</style>