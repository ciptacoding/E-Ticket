<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router, usePage, Link } from "@inertiajs/vue3";
import { watch, ref } from "vue";
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

const checkin = async (id, gender, userId) => {
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
            router.post(`/checkin`, { id: id, gender: gender, userId: userId });
            await new Promise((resolve) => setTimeout(resolve, 2000));
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
            await new Promise((resolve) => setTimeout(resolve, 2000));
            if (usePage().props.flash.message !== null) {
                notyf.success(usePage().props.flash.message);
                usePage().props.flash.message = null;
            }
        }
    });
};
</script>

<template>
    <div>
        <Head title="Dashboard | Entrance" />

        <DashboardLayout>
            <template #title> Dashboard Entrances </template>

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
                    <div class="my-2 flex items-end gap-2">
                        <div class="flex flex-col justify-start">
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

                        <Link
                            class="w-20 h-10 flex items-center gap-1 text-white bg-black hover:bg-gradient-to-br font-medium rounded-lg text-sm p-2.5 text-center mb-2"
                            :href="route('entrance.scan')"
                            ><Icon icon="mdi:line-scan" class="text-xl" />
                            Scan
                        </Link>
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
                                            Full Name
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Check In Date
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Check Out Date
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Status Entrance
                                        </th>
                                        <th
                                            class="px-6 py-4 flex justify-center text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    <tr
                                        v-for="entrance in entrances.data"
                                        :key="entrance.id"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="text-sm font-medium leading-5 text-gray-900"
                                                >
                                                    {{ entrance.id }}
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ entrance.full_name }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ entrance.check_in }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ entrance.check_out }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{
                                                    entrance.entrance
                                                        ? entrance.entrance
                                                              .status_entrances
                                                        : "-"
                                                }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 gap-1 flex justify-center leading-5 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <button
                                                v-if="
                                                    entrance.entrance === null
                                                "
                                                @click.prevent="
                                                    checkin(
                                                        entrance.id,
                                                        entrance.gender,
                                                        entrance.user_id
                                                    )
                                                "
                                                class="text-xs bg-green-400 text-white px-4 py-2 rounded-lg"
                                            >
                                                Check-In
                                            </button>
                                            <button
                                                v-if="
                                                    entrance.entrance &&
                                                    entrance.entrance
                                                        .status_entrances ==
                                                        'Check In'
                                                "
                                                @click.prevent="
                                                    checkout(entrance.id)
                                                "
                                                class="text-xs bg-red-700 text-white px-3 py-2 rounded-lg"
                                            >
                                                Check-Out
                                            </button>
                                            <p
                                                v-if="
                                                    entrance.entrance &&
                                                    entrance.entrance
                                                        .status_entrances ==
                                                        'Check Out'
                                                "
                                                class="font-medium"
                                            >
                                                Finished
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="entrances.links" />
                        </div>
                    </div>
                </div>
            </template>
        </DashboardLayout>
    </div>
</template>
