<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import GuestLayout from "@/layouts/GuestLayout.vue";
import {useAuthStore} from "@/stores/authStore.js";
import FormInput from "@/components/Auth/FormInput.vue";
import PrimaryButton from "@/components/UI/PrimaryButton.vue";

const router = useRouter();
const auth = useAuthStore();
const form = ref({
  email: '',
  password: '',
});

const submit = async () => {
  const success = await auth.login(form.value)

  if (success && auth.state.waitCode) {
    await router.push('/verify-code')
  }
};
</script>

<template>
  <GuestLayout>
    <form class="form" @submit.prevent="submit">
        <p class="subtitle">Вход</p>
        <FormInput
            label="Email"
            type="email"
            v-model="form.email"
            :error="auth.state.errors?.email?.[0]"
        />
        <FormInput
            label="Пароль"
            type="password"
            v-model="form.password"
            :error="auth.state.errors?.password?.[0]"
        />

        <PrimaryButton class="form-btn" type="submit"> Войти </PrimaryButton>
    </form>
  </GuestLayout>
</template>

<style>
.subtitle {
  font-size: 21px;
  margin-bottom: 20px;
}

.form {
  font-family: "Inria Sans", sans-serif;
  background-color: rgba(217, 217, 217, 0.05);
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.25);
  border-radius: 20px;
  padding: 45px;
  width: 430px;
  max-width: 100%;
}

.form-btn {
  width: 345px;
}

</style>