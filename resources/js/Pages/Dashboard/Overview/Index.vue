<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router, Link } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
    data: {
        type: Object,
    },
});
</script>

<template>
    <div>
        <Head title="Dashboard | Overview" />
        <DashboardLayout>
            <template #title> Dashboard </template>
            <template #searching>
                <h2 class="font-semibold text-xl text-[#DF6951] leading-tight">
                    Detail Overview
                </h2>
            </template>
            <template #main>
                <div class="mt-4">
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-10"
                    >
                        <Link :href="route('users.index')">
                            <div
                                class="flex items-center px-5 py-10 bg-white rounded-md shadow-sm"
                            >
                                <div
                                    class="p-3 bg-indigo-600 bg-opacity-75 rounded-full"
                                >
                                    <Icon
                                        icon="solar:users-group-two-rounded-bold"
                                        height="30"
                                        color="#ffffff"
                                    />
                                </div>

                                <div class="mx-5">
                                    <h4
                                        class="text-2xl font-semibold text-gray-700"
                                    >
                                        {{ props.data.users }}
                                    </h4>
                                    <div class="text-gray-500">Total Users</div>
                                </div>
                            </div>
                        </Link>
                        <Link :href="route('posts.index')">
                            <div
                                class="flex items-center px-5 py-10 bg-white rounded-md shadow-sm"
                            >
                                <div
                                    class="p-3 bg-green-600 bg-opacity-75 rounded-full"
                                >
                                    <Icon
                                        icon="solar:document-add-bold"
                                        height="30"
                                        color="#ffffff"
                                    />
                                </div>

                                <div class="mx-5">
                                    <h4
                                        class="text-2xl font-semibold text-gray-700"
                                    >
                                        {{ props.data.posts }}
                                    </h4>
                                    <div class="text-gray-500">Total News</div>
                                </div>
                            </div>
                        </Link>
                        <Link :href="route('blacklists.index')">
                            <div
                                class="flex items-center px-5 py-10 bg-white rounded-md shadow-sm"
                            >
                                <div
                                    class="p-3 bg-red-700 bg-opacity-75 rounded-full"
                                >
                                    <Icon
                                        icon="solar:user-block-bold"
                                        height="30"
                                        color="#ffffff"
                                    />
                                </div>

                                <div class="mx-5">
                                    <h4
                                        class="text-2xl font-semibold text-gray-700"
                                    >
                                        {{ props.data.blacklists }}
                                    </h4>
                                    <div class="text-gray-500">
                                        Total Blacklists
                                    </div>
                                </div>
                            </div>
                        </Link>
                        <Link :href="route('transaction.index')">
                            <div
                                class="flex items-center px-5 py-10 bg-white rounded-md shadow-sm"
                            >
                                <div
                                    class="p-3 bg-pink-600 bg-opacity-75 rounded-full"
                                >
                                    <Icon
                                        icon="solar:ticket-sale-bold"
                                        height="30"
                                        color="#ffffff"
                                    />
                                </div>

                                <div class="mx-5">
                                    <h4
                                        class="text-2xl font-semibold text-gray-700"
                                    >
                                        {{ props.data.transactions }}
                                    </h4>
                                    <div class="text-gray-500">
                                        Total Transactions
                                    </div>
                                </div>
                            </div>
                        </Link>
                        <Link :href="route('entrance.index')">
                            <div
                                class="flex items-center px-5 py-10 bg-white rounded-md shadow-sm"
                            >
                                <div
                                    class="p-3 bg-fuchsia-600 bg-opacity-75 rounded-full"
                                >
                                    <Icon
                                        icon="solar:checklist-minimalistic-bold"
                                        height="30"
                                        color="#ffffff"
                                    />
                                </div>

                                <div class="mx-5">
                                    <h4
                                        class="text-2xl font-semibold text-gray-700"
                                    >
                                        {{ props.data.entrances }}
                                    </h4>
                                    <div class="text-gray-500">
                                        Currently Climbing
                                    </div>
                                </div>
                            </div>
                        </Link>
                        <Link :href="route('suggestions.index')">
                            <div
                                class="flex items-center px-5 py-10 bg-white rounded-md shadow-sm"
                            >
                                <div
                                    class="p-3 bg-yellow-600 bg-opacity-75 rounded-full"
                                >
                                    <Icon
                                        icon="solar:wallet-bold"
                                        height="30"
                                        color="#ffffff"
                                    />
                                </div>

                                <div class="mx-5">
                                    <h4
                                        class="text-2xl font-semibold text-gray-700"
                                    >
                                        {{ props.data.suggestions }}
                                    </h4>
                                    <div class="text-gray-500">
                                        Total Suggestions
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </template>
        </DashboardLayout>
    </div>
</template>
