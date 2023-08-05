<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router, Link } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
    blacklists: {
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
        "/blacklists",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

const deleteBlacklist = (id) => {
    if (confirm("Are you sure ?")) {
        router.delete(`blacklists/${id}`);
    }
};

const updateBlacklist = (id) => {
    router.get(`blacklists/${id}/edit`);
};

const truncateDescription = (blacklist) => {
    let description = stripTags(blacklist.description);
    return description.length > 30
        ? description.substring(0, 30) + "..."
        : description;
};

const stripTags = (text) => {
    return text.replace(/(<([^>]+)>)/gi, "");
};
</script>

<template>
    <div>
        <Head title="Dashboard | Blacklists" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Blacklists
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <div class="mb-4 flex justify-between">
                                <input
                                    id="search"
                                    name="search"
                                    type="text"
                                    v-model="search"
                                    placeholder="Search..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-2/6 p-2.5 ml-4 h-[41px]"
                                />

                                <Link
                                    class="mr-4 flex items-center gap-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2"
                                    :href="route('blacklists.create')"
                                    ><Icon
                                        icon="solar:add-circle-linear"
                                        class="text-xl"
                                    />
                                    Add Blacklists
                                </Link>
                            </div>
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Full Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Start Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            End Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
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
                                        v-for="blacklist in blacklists.data"
                                        :key="blacklist.id"
                                        class="bg-white border-b"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ blacklist.full_name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ blacklist.user.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ blacklist.start_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ blacklist.end_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ truncateDescription(blacklist) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center gap-2"
                                        >
                                            <button
                                                title="Update"
                                                @click.prevent="
                                                    updateBlacklist(
                                                        `${blacklist.id}`
                                                    )
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:gallery-edit-bold"
                                                />
                                            </button>
                                            <button
                                                title="Delete"
                                                @click.prevent="
                                                    deleteBlacklist(
                                                        `${blacklist.id}`
                                                    )
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
                            <Pagination :links="blacklists.links" />
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
