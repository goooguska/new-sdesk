<script setup>
import { Pie, Bar, Doughnut } from 'vue-chartjs';
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import {onMounted} from "vue";
import {useDashboardCharts} from "@/composables/useDashboardCharts.js";
import {chartOptions} from "@/utils/chartUtils.js";
import ChartWrapper from "@/components/Dashboard/ChartWrapper.vue";

const {
  categoryData,
  weeklyData,
  statusData,
  fetchChartData
} = useDashboardCharts();

onMounted(fetchChartData);
</script>

<template>
  <AuthenticatedLayout>
    <div class="dashboard-container">
      <ChartWrapper
          v-if="categoryData"
          title="Распределение заявок по категориям"
          :data="categoryData"
          :labels="categoryData.labels"
          :values="categoryData.datasets[0].data"
      >
        <Pie
            :data="categoryData"
            :options="{
            ...chartOptions,
            plugins: {
              ...chartOptions.plugins,
              tooltip: {
                callbacks: {
                  label: (context) => `${context.label}: ${context.raw} шт.`
                }
              }
            }
          }"
        />
      </ChartWrapper>

      <ChartWrapper
          v-if="weeklyData"
          class="main-chart"
          title="Количество выполненных заявок за неделю"
          :data="weeklyData"
          :labels="weeklyData.labels"
          :values="weeklyData.datasets[0].data"
      >
        <Bar
            :data="weeklyData"
            :options="{
            ...chartOptions,
            plugins: {
              ...chartOptions.plugins,
              tooltip: {
                callbacks: {
                  label: (context) => `${context.label}: ${context.raw} шт.`
                }
              }
            }
          }"
        />
      </ChartWrapper>

      <ChartWrapper
          v-if="statusData"
          title="Соотношение выполненных и отклоненных заявок за неделю"
          :data="statusData"
          :labels="statusData.labels"
          :values="statusData.datasets[0].data"
          suffix="%"
      >
        <Doughnut :data="statusData" :options="chartOptions" />
      </ChartWrapper>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.dashboard-container {
  display: grid;
  grid-template-columns: 1fr 2fr 1fr;
  gap: 16px;
  min-height: 60vh;
}
.chart-block {
  background: white;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
}
.main-chart {
  grid-column: 2 / 3;
}
</style>