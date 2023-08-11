<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import { watch, ref, onMounted } from "vue";
import { Icon } from "@iconify/vue";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";
import Swal from "sweetalert2";

const notyf = new Notyf({
    duration: 3000,
    position: {
        x: "center",
        y: "top",
    },
});

const props = defineProps({
    entrances: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const search = ref(props.filters.search);
const date = ref(props.filters.date);

watch([search, date], ([searchValue, dateValue]) => {
    router.get(
        "/entrance",
        { search: searchValue, date: dateValue },
        { preserveState: true, replace: true }
    );
});

const checkin = async (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Check-In!",
    }).then(async (result) => {
        if (result.isConfirmed) {
            router.post(`/checkin`, { id: id });
            await new Promise((resolve) => setTimeout(resolve, 1000));
            if (usePage().props.flash.message !== null) {
                notyf.success(usePage().props.flash.message);
                usePage().props.flash.message = null;
            }
        }
    });
};

const checkout = async (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Check-Out!",
    }).then(async (result) => {
        if (result.isConfirmed) {
            router.post(`/checkout`, { id: id });
            await new Promise((resolve) => setTimeout(resolve, 1000));
            if (usePage().props.flash.message !== null) {
                notyf.success(usePage().props.flash.message);
                usePage().props.flash.message = null;
            }
        }
    });
};

const blacklist = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Blacklist!",
    }).then(async (result) => {
        if (result.isConfirmed) {
            router.post("/entrance", { id: id });
        }
    });
};
</script>

<template>
    <div>
        <Head title="Dashboard | Entrance" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Entrance
                </h2>
            </template>

            <div class="py-8">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 justify-between"
                            >
                                <div class="mb-4">
                                    <input
                                        id="search"
                                        name="search"
                                        type="text"
                                        v-model="search"
                                        placeholder="Search..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-2/3 p-2.5 ml-4"
                                    />
                                </div>
                                <div class="mb-4 flex md:justify-end">
                                    <input
                                        v-model="date"
                                        type="date"
                                        id="start_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-2/3 lg:w-2/6 p-2.5 ml-4 md:ml-0 md:mr-4"
                                        required
                                        placeholder="filter"
                                    />
                                </div>
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
                                            Check In Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Check Out Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status Entrance
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="entrance in entrances.data"
                                        :key="entrance.id"
                                        class="bg-white border-b"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ entrance.id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ entrance.full_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ entrance.check_in }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ entrance.check_out }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{
                                                entrance.entrance
                                                    ? entrance.entrance
                                                          .status_entrances
                                                    : "-"
                                            }}
                                        </td>
                                        <!-- <td
                                            class="px-6 py-4 flex gap-2 justify-center"
                                        >
                                            <button
                                                :disabled="
                                                    entrance.entrance
                                                        .status_entrances ==
                                                    null
                                                        ? false
                                                        : true
                                                "
                                                :class="
                                                    entrance.entrance
                                                        .status_entrances ==
                                                    null
                                                        ? ''
                                                        : 'opacity-25 cursor-not-allowed'
                                                "
                                                title="Check In"
                                                @click.prevent="
                                                    checkin(`${entrance.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:user-check-outline"
                                                    color="#26c968"
                                                />
                                            </button>
                                            <button
                                                :disabled="
                                                    entrance.status_entrance ==
                                                    'Check In'
                                                        ? false
                                                        : true
                                                "
                                                :class="
                                                    entrance.status_entrance ==
                                                    'Check In'
                                                        ? ''
                                                        : 'opacity-25 cursor-not-allowed'
                                                "
                                                title="Check Out"
                                                @click.prevent="
                                                    checkout(`${entrance.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:user-minus-outline"
                                                    color="#cf1717"
                                                />
                                            </button>
                                            <button
                                                :disabled="
                                                    entrance.status_entrance ==
                                                    'Check In'
                                                        ? false
                                                        : true
                                                "
                                                :class="
                                                    entrance.status_entrance ==
                                                    'Check In'
                                                        ? ''
                                                        : 'opacity-25 cursor-not-allowed'
                                                "
                                                title="Blacklist"
                                                @click.prevent="
                                                    blacklist(`${entrance.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:user-block-outline"
                                                />
                                            </button>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="entrances.links" />
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
