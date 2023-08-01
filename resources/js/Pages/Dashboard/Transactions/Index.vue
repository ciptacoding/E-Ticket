<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
    transactions: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

let search = ref(props.filters.search);

watch(search, (value) => {
    router.get(
        "/transaction",
        { search: value },
        { preserveState: true, replace: true }
    );
});

const detail = (id) => {
    router.get(`/transaction/${id}`);
};
</script>

<template>
    <div>
        <Head title="Dashboard | Transaction" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Transaction
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <div class="mb-4">
                                <input
                                    id="search"
                                    name="search"
                                    type="text"
                                    v-model="search"
                                    placeholder="Search..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-2/6 p-2.5 ml-4"
                                />
                            </div>
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Order ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Full Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Detail
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="transaction in transactions.data"
                                        :key="transaction.id"
                                        class="bg-white border-b"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ transaction.id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ transaction.full_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.phone }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ transaction.status }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center"
                                        >
                                            <button
                                                @click.prevent="
                                                    detail(`${transaction.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:eye-scan-line-duotone"
                                                />
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="transactions.links" />
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
