import {defineStore} from "pinia";
import axiosInstance from "@/utils/api.js";
import {ref} from "vue";

export const useStatusStore = defineStore('statusStore', () => {

    const statuses = ref([])

    const getAllStatuses = async () => {
        try {
            const { data } = await axiosInstance.get(`/statuses`);
            statuses.value = data.data;
        } catch (error) {
            console.error(`Ошибка при получении данных для статусов:`, error);
        }
    }

    return { statuses, getAllStatuses }
});
