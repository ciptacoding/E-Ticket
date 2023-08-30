<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router } from "@inertiajs/vue3";
import { watch, ref, onMounted } from "vue";
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
let date = ref(props.filters.date);

watch([search, date], ([searchValue, dateValue]) => {
    router.get(
        "/transaction",
        { search: searchValue, date: dateValue },
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
            <template #title> Dashboard Transactions </template>

            <template #searching>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg
                        class="w-5 h-5 text-gray-500"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </span>
                <input
                    class="w-32 pl-10 pr-4 rounded-md form-input sm:w-80 focus:ring-black focus:border-black"
                    type="text"
                    placeholder="Search"
                    id="search"
                    name="search"
                    v-model="search"
                />
            </template>

            <template #main>
                <div class="mx-auto">
                    <div class="my-2 flex flex-col justify-start">
                        <label for="filter" class="text-[#DF6951] font-bold"
                            >Date Filter
                        </label>
                        <input
                            v-model="date"
                            type="date"
                            id="filter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-[#DF6951] focus:border-[#DF6951] w-32 lg:w-80 p-2.5 mb-2"
                            required
                            placeholder="filter"
                        />
                    </div>

                    <div
                        class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
                    >
                        <div
                            class="inline-block min-w-full overflow-hidden align-middle border-b bg-white border-gray-200 shadow sm:rounded-lg pb-4"
                        >
                            <table class="min-w-full mb-2">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Order ID
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Order Date
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Full Name
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Phone
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-4 flex justify-center text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Details
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    <tr
                                        v-for="transaction in transactions.data"
                                        :key="transaction.id"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="text-sm font-medium leading-5 text-gray-900"
                                                >
                                                    {{ transaction.id }}
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ transaction.order_date }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ transaction.full_name }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ transaction.phone }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                v-if="
                                                    transaction.status ===
                                                    'Paid'
                                                "
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                                            >
                                                {{ transaction.status }}
                                            </div>

                                            <div
                                                v-if="
                                                    transaction.status ===
                                                    'Unpaid'
                                                "
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-400 rounded-full"
                                            >
                                                {{ transaction.status }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 gap-1 flex justify-center leading-5 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <button
                                                @click.prevent="
                                                    detail(`${transaction.id}`)
                                                "
                                                class="bg-black py-1 px-2 rounded-lg"
                                            >
                                                <Icon
                                                    color="#ffffff"
                                                    height="22"
                                                    width="22"
                                                    icon="solar:eye-outline"
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
            </template>
        </DashboardLayout>
    </div>
</template>
