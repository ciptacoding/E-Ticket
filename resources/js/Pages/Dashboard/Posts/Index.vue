<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router, Link } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
    posts: {
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
        "/posts",
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

const truncatePostBody = (post) => {
    let body = stripTags(post.body);
    return body.length > 10 ? body.substring(0, 10) + "..." : body;
};

const truncateExcerpt = (post) => {
    let excerpt = stripTags(post.excerpt);
    return excerpt.length > 10 ? excerpt.substring(0, 10) + "..." : excerpt;
};

const stripTags = (text) => {
    return text.replace(/(<([^>]+)>)/gi, "");
};
</script>

<template>
    <div>
        <Head title="Dashboard | Posts" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Posts
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    class="mr-4 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2"
                                    :href="route('posts.create')"
                                    >Add New Post
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
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Excerpt
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Body
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
                                        v-for="post in posts.data"
                                        :key="post.id"
                                        class="bg-white border-b"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ post.title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ post.date_post }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ truncateExcerpt(post) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ truncatePostBody(post) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex justify-center gap-2"
                                        >
                                            <button>
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:eye-scan-line-duotone"
                                                />
                                            </button>
                                            <button>
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:gallery-edit-bold"
                                                />
                                            </button>
                                            <button
                                                @click.prevent="
                                                    deleteUser(`${post.id}`)
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
                            <Pagination :links="posts.links" />
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
