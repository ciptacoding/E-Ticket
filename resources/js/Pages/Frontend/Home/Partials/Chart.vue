<template>
    <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
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

export default {
    name: "BarChart",
    components: { Bar },
    data() {
        return {
            chartData: {
                labels: ["Total", "Male", "Female"],
                datasets: [
                    {
                        label: "Statistics Today",
                        backgroundColor: "#3b82f6",
                        data: [749, 478, 271],
                    },
                ],
            },
            chartOptions: {
                responsive: true,
            },
        };
    },
};
</script>
