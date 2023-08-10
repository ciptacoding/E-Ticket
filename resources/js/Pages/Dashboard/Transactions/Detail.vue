<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    transaction: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div>
        <Head title="Dashboard | Detail Transaction" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Transaction
                </h2>
            </template>

            <div class="py-8">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <button>
                                <Link :href="route('transaction.index')">
                                    <Icon
                                        class="ml-8 font-medium text-4xl hover:bg-black hover:text-white rounded-2xl"
                                        icon="solar:round-arrow-left-outline"
                                    />
                                </Link>
                            </button>
                            <div
                                class="flex flex-col justify-center items-center mx-4 sm:mx-12"
                            >
                                <h1 class="text-center text-xl font-bold">
                                    Detail Transaction
                                </h1>
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <tbody>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                1. Order ID :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.id }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                2. Order Date :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.order_date }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                3. Fullname :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.full_name }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                4. Username :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.username }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                5. Email :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.email }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                6. Check In :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.check_in }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                7. Check Out :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.check_out }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                8. Address :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.address }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                9. Phone :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.phone }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                10. Gender :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.gender }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                11. Status :
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ transaction.status }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
