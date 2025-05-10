import {defineStore} from "pinia";
import {ref} from "vue";
import axiosInstance from "@/utils/api.js";

export const useDashboardStore = defineStore('dashboardStore', () => {

    const dayTranslation = {
        Monday: 'Понедельник',
        Tuesday: 'Вторник',
        Wednesday: 'Среда',
        Thursday: 'Четверг',
        Friday: 'Пятница',
        Saturday: 'Суббота',
        Sunday: 'Воскресенье'
    };

    const statusLabelMap = {
        done: 'Выполненные',
        rejected: 'Отклонённые',
    };

    const statistics = ref([])

    const getStatistics = async () => {
        try {
            const { data } = await axiosInstance.get(`/dashboard/statistics`);
            statistics.value = data;

        } catch (error) {
            console.error(`Ошибка при получении данных для статистики:`, error);
        }
    }

    return { getStatistics, statistics, dayTranslation, statusLabelMap }
});
