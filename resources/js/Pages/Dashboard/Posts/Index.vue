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

const truncatePostTitle = (post) => {
    let body = stripTags(post.body);
    return body.length > 20 ? body.substring(0, 20) + "..." : body;
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
            <template #title> Dashboard Posts </template>
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
                    <div class="my-2 flex justify-start">
                        <Link
                            class="flex items-center gap-1 text-white bg-[#DF6951] font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2"
                            :href="route('posts.create')"
                            ><Icon
                                icon="solar:add-circle-linear"
                                class="text-xl"
                            />
                            Add New Post
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
                                    <tr class="border-b border-gray-200">
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                                        >
                                            Title
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                                        >
                                            Date
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                                        >
                                            Excerpt
                                        </th>
                                        <th
                                            class="px-6 py-4 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                                        >
                                            Content
                                        </th>
                                        <th
                                            class="px-6 py-4 flex justify-center text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    <tr
                                        class="border-b border-gray-200"
                                        v-for="post in posts.data"
                                        :key="post.id"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="text-sm font-medium leading-5 text-gray-900"
                                                >
                                                    {{
                                                        truncatePostTitle(post)
                                                    }}
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ post.date_post }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-no-wrap"
                                        >
                                            <div
                                                class="text-sm leading-5 text-gray-900"
                                            >
                                                {{ truncateExcerpt(post) }}
                                            </div>
                                        </td>

                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ truncatePostBody(post) }}
                                        </td>

                                        <td
                                            class="px-6 py-4 gap-1 flex justify-center leading-5 whitespace-no-wrap"
                                        >
                                            <button
                                                class="bg-black opacity-80 py-1 px-2 rounded-lg"
                                                @click.prevent="
                                                    showPost(`${post.id}`)
                                                "
                                            >
                                                <Icon
                                                    color="#ffffff"
                                                    height="22"
                                                    width="22"
                                                    icon="solar:eye-outline"
                                                />
                                            </button>
                                            <button
                                                @click.prevent="
                                                    updatePost(`${post.id}`)
                                                "
                                                class="bg-yellow-400 py-1 px-2 rounded-lg"
                                            >
                                                <Icon
                                                    height="22"
                                                    width="22"
                                                    icon="mdi:square-edit-outline"
                                                    color="#ffffff"
                                                />
                                            </button>
                                            <button
                                                @click.prevent="
                                                    deletePost(`${post.id}`)
                                                "
                                                class="bg-red-600 py-1 px-2 rounded-lg"
                                            >
                                                <Icon
                                                    height="22"
                                                    width="22"
                                                    icon="solar:trash-bin-minimalistic-outline"
                                                    color="#ffffff"
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
            </template>
        </DashboardLayout>
    </div>
</template>
