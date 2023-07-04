<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link, Head, router } from "@inertiajs/vue3";

const props = defineProps({
    users: {
        type: Object,
    },
});

const deleteUser = (id) => {
    if (confirm("Are you sure ?")) {
        router.delete(`/users/${id}`);
    }
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

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div class="relative overflow-x-auto rounded-md">
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
                                        v-for="user in users"
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
                                                class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-xs px-4 py-2"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
