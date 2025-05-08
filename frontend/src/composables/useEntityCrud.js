import { useRoute } from 'vue-router';
import { computed } from 'vue';
import { useAdminStore } from '@/stores/adminStore.js';
import axiosInstance from "@/utils/api.js";

export function useEntityCrud() {
    const route = useRoute();
    const adminStore = useAdminStore();

    const entityCode = computed(() => route.name);

    const baseUrl = computed(() => `/admin/${entityCode.value}`);

    const createEntity = async (data) => {
        try {
            await axiosInstance.post(`${baseUrl.value}/create`, data);
            await adminStore.getData(entityCode.value);
        } catch (error) {
            console.error(`Ошибка при создании ${entityCode.value}:`, error);
            throw error;
        }
    };

    const updateEntity = async (id, data) => {
        try {
            console.log(data)
            await axiosInstance.patch(`${baseUrl.value}/${id}/update`, data);
            await adminStore.getData(entityCode.value);
        } catch (error) {
            console.error(`Ошибка при обновлении ${entityCode.value}:`, error);
            throw error;
        }
    };

    const deleteEntity = async (id) => {
        try {
            await axiosInstance.delete(`${baseUrl.value}/${id}/delete`);
            await adminStore.getData(entityCode.value);
        } catch (error) {
            alert(`Ошибка при удалении записи ${error}`)
            console.error(`Ошибка при удалении ${entityCode.value}:`, error);
            throw error;
        }
    };

    const getEntity = async (id) => {
        try {
            const { data } = await axiosInstance.get(`${baseUrl.value}/${id}`);
            return data;
        } catch (error) {
            console.error(`Ошибка при получении ${entityCode.value}:`, error);
            throw error;
        }
    };

    return {
        createEntity,
        updateEntity,
        deleteEntity,
        getEntity
    };
}
