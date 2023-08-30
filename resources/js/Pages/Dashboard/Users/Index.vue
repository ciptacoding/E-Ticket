<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { Icon } from "@iconify/vue";
import Swal from "sweetalert2";

const props = defineProps({
    users: {
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
        "/users",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

const deleteUser = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/users/${id}`, {
                onFinish: () =>
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    ),
            });
        }
    });
};
</script>

<template>
    <div>
        <Head title="Dashboard | Users" />

        <DashboardLayout>
            <template #title> Dashboard Users </template>
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
                <div class="flex flex-col mt-5">
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
                                            Username
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Email
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                        >
                                            Role
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
                                        v-for="user in users.data"
                                        :key="user.id"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="text-sm font-medium leading-5 text-gray-900"
                                                >
                                                    {{ user.name }}
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ user.email }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                                                >Active</span
                                            >
                                        </td>

                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            {{ user.role }}
                                        </td>

                                        <td
                                            class="px-6 py-4 flex justify-center leading-5 whitespace-no-wrap border-b border-gray-200"
                                        >
                                            <button
                                                class="bg-red-600 py-1 px-3 rounded-md"
                                                @click.prevent="
                                                    deleteUser(`${user.id}`)
                                                "
                                            >
                                                <Icon
                                                    width="24"
                                                    height="24"
                                                    icon="solar:trash-bin-minimalistic-outline"
                                                    color="#ffffff"
                                                />
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="users.links" />
                        </div>
                    </div>
                </div>
            </template>
        </DashboardLayout>
    </div>
</template>
