import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    ArcElement,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js';

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    ArcElement,
    BarElement,
    CategoryScale,
    LinearScale
);

export const generateColors = (count) => {
    const baseColors = [
        '#2563EB', '#22D3EE', '#A855F7', '#F97316',
        '#10B981', '#EF4444', '#F59E0B', '#8B5CF6'
    ];
    return Array.from({ length: count }, (_, i) => baseColors[i % baseColors.length]);
};

export const chartOptions = {
    plugins: {
        legend: {
            position: 'bottom',
            labels: {
                boxWidth: 12,
                padding: 10,
            }
        },
        title: { display: false },
        tooltip: {
            callbacks: {
                label: (context) => {
                    const label = context.label || '';
                    const count = context.chart.data.datasets[0].countData?.[context.dataIndex] ?? 0;
                    return `${label}: ${count} шт.`;
                }
            }
        }
    },
};
