<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import GuestLayout from "@/layouts/GuestLayout.vue";
import {useAuthStore} from "@/stores/authStore.js";
import FormInput from "@/components/Auth/FormInput.vue";
import PrimaryButton from "@/components/UI/PrimaryButton.vue";

const router = useRouter();
const auth = useAuthStore();
const code = ref('');

const verify = async () => {
  try {
    const success = await auth.verifyCode(code.value)

    if (success) {
      await router.push('/home')
    }
  } catch (error) {
    console.error('Verification failed:', error);
  }
};
</script>

<template>
  <GuestLayout>
    <div class="verify-code">
      <form class="form" @submit.prevent="verify">
        <p class="subtitle">Введите код из письма</p>
        <FormInput
            label="Код"
            type="text"
            v-model="code"
            :error="auth.errors?.code?.[0]"
        />

        <PrimaryButton class="form-btn" type="submit"> Подтвердить код </PrimaryButton>
      </form>
    </div>
  </GuestLayout>
</template>

<style>
.subtitle {
  font-size: 21px;
  margin-bottom: 20px;
  text-align: center;
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