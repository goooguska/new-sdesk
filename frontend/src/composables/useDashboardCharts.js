import { ref } from 'vue';
import { useDashboardStore } from '@/stores/dashboardStore';
import { generateColors } from '@/utils/chartUtils';

export const useDashboardCharts = () => {
    const categoryData = ref(null);
    const weeklyData = ref(null);
    const statusData = ref(null);

    const dashboardStore = useDashboardStore();

    const fetchChartData = async () => {
        try {
            await dashboardStore.getStatistics();
            const { categories, weekly, status } = dashboardStore.statistics;

            const categoryLabels = Object.keys(categories).filter(k => k !== 'total');
            const categoryValues = categoryLabels.map(label => categories[label]);

            categoryData.value = {
                labels: categoryLabels,
                datasets: [{
                    label: 'Количество',
                    data: categoryValues,
                    backgroundColor: generateColors(categoryLabels.length),
                }],
                total: categories.total
            };

            const translatedWeekly = {};
            Object.keys(weekly).forEach(key => {
                translatedWeekly[key === 'total' ? key : dashboardStore.dayTranslation[key] || key] = weekly[key];
            });

            const weekDays = Object.keys(translatedWeekly).filter(k => k !== 'total');
            weeklyData.value = {
                labels: weekDays,
                datasets: [{
                    label: 'Выполнено',
                    data: weekDays.map(day => translatedWeekly[day]),
                    backgroundColor: '#047857',
                }],
                total: translatedWeekly.total
            };

            const statusKeys = ['done', 'rejected'];
            statusData.value = {
                labels: statusKeys.map(key => dashboardStore.statusLabelMap[key]),
                datasets: [{
                    label: 'Статус',
                    data: statusKeys.map(key => status[key].percent),
                    countData: statusKeys.map(key => status[key].count),
                    backgroundColor: ['#047857', '#B91C1C'],
                }],
                total: status.total
            };

        } catch (error) {
            console.error('Ошибка загрузки графиков:', error);
        }
    };

    return {
        categoryData,
        weeklyData,
        statusData,
        fetchChartData
    };
};
