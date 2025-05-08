import { computed, watch, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useAdminStore } from "@/stores/adminStore.js";

export function useEntityData() {
    const route = useRoute();
    const adminStore = useAdminStore();

    const entityCode = computed(() => route.name);

    const items = computed(() => adminStore[entityCode.value] || []);
    const loading = ref(false);

    const loadData = async () => {
        if (!entityCode.value) return;
        loading.value = true;
        await adminStore.getData(entityCode.value);
        loading.value = false;
    };

    onMounted(loadData);
    watch(entityCode, loadData);

    return {
        entityCode,
        items,
        loading
    };
}
