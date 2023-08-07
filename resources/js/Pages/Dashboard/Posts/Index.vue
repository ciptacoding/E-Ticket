<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router, Link, usePage } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { Icon } from "@iconify/vue";
import Swal from "sweetalert2";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";

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

const showPost = (id) => {
    router.get(`posts/${id}`);
};

const deletePost = (id) => {
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
            router.delete(`/posts/${id}`, {
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

const updatePost = (id) => {
    router.get(`posts/${id}/edit`);
};

const truncatePostBody = (post) => {
    let body = stripTags(post.body);
    return body.length > 20 ? body.substring(0, 20) + "..." : body;
};

const truncateExcerpt = (post) => {
    let excerpt = stripTags(post.excerpt);
    return excerpt.length > 20 ? excerpt.substring(0, 20) + "..." : excerpt;
};

const stripTags = (text) => {
    return text.replace(/(<([^>]+)>)/gi, "");
};

const notyf = new Notyf({
    duration: 3000,
    position: {
        x: "center",
        y: "top",
    },
});

if (usePage().props.flash.message !== null) {
    notyf.success(usePage().props.flash.message);
}
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

            <div class="py-8">
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
                                    :href="route('posts.create')"
                                    ><Icon
                                        icon="solar:add-circle-linear"
                                        class="text-xl"
                                    />
                                    Add New Post
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
                                            <button
                                                @click.prevent="
                                                    showPost(`${post.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:eye-scan-line-duotone"
                                                />
                                            </button>
                                            <button
                                                @click.prevent="
                                                    updatePost(`${post.id}`)
                                                "
                                            >
                                                <Icon
                                                    class="text-3xl"
                                                    icon="solar:gallery-edit-bold"
                                                />
                                            </button>
                                            <button
                                                @click.prevent="
                                                    deletePost(`${post.id}`)
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
