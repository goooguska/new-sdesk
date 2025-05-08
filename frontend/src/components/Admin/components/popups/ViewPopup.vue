<script setup>
import BasePopup from './BasePopup.vue';
import {computed} from "vue";
import {useAdminStore} from "@/stores/adminStore.js";
import {formatSimpleObject} from "@/utils/formatObject.js";

const props = defineProps({ item: Object });
const emit = defineEmits(['close']);

const adminStore = useAdminStore()

const formattedItem = computed(() => {
  const result = { ...props.item };
  if ('name' in result && 'surname' in result) {
    result.name = `${result.name} ${result.surname}`;
    delete result.surname;
  }
  return result;
});
</script>

<template>
  <BasePopup title="Просмотр" @close="$emit('close')">
    <ul>
      <li v-for="(value, key) in formattedItem" :key="key">
        <strong>{{ adminStore.adminFieldMap[key] ?? key }}:</strong> {{ formatSimpleObject(value) }}
      </li>
    </ul>
  </BasePopup>
</template>

