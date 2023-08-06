<script setup>
import { Bar } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
} from "chart.js";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
);

const props = defineProps({
    total: {
        type: Number,
    },
    male: {
        type: Number,
    },
    female: {
        type: Number,
    },
});

const chartData = {
    labels: ["Total", "Male", "Female"],
    datasets: [
        {
            label: "Statistics Today",
            backgroundColor: "#3b82f6",
            data: [props.total, props.male, props.female],
        },
    ],
};

const chartOptions = {
    responsive: true,
};
</script>

<template>
    <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>
