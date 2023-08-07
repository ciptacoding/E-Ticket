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
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Users
                </h2>
            </template>

            <div class="py-8">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
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
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Role
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="user in users.data"
                                        :key="user.id"
                                        class="bg-white border-b"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ user.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ user.role }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center"
                                        >
                                            <button
                                                @click.prevent="
                                                    deleteUser(`${user.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:trash-bin-minimalistic-outline"
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
            </div>
        </DashboardLayout>
    </div>
</template>
