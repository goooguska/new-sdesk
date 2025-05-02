<script setup>
import ErrorLabel from "@/components/Errors/ErrorLabel.vue";

defineProps({
  label: String,
  error: String,
  type: {
    type: String,
    default: 'text'
  },
  placeholder: {
    type: String,
    default: ''
  },
  modelValue: [String, Number]
});
</script>

<template>
  <div class="form-input">
    <label class="form-input__label">{{ label }}</label>
    <input
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        class="form-input__input"
        :class="{ 'input-error': error }"
    >

    <div v-if="error">
      <ErrorLabel :error/>
    </div>

  </div>
</template>

<style scoped>
.form-input {
  display: flex;
  flex-direction: column;
  margin-bottom: 1.5rem;
  width: 100%;
}

.form-input__label {
  font-size: 12px;
  color: var(--gray);
  margin-bottom: 0.5rem;
  font-weight: 500;
}

.form-input__input {
  padding: 0.75rem 1rem;
  border: 1px solid var(--light-gray);
  border-radius: 2px;
  background-color: var(--white);
  font-size: 1rem;
  transition: border-color 0.2s ease;
}
</style>