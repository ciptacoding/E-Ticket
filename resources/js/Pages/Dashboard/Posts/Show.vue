<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div>
        <Head title="Dashboard | Create Post" />

        <DashboardLayout>
            <template #searching>
                <h2 class="font-semibold text-xl text-[#DF6951] leading-tight">
                    Show Detail Post
                </h2>
            </template>
            <template #main>
                <div class="mx-auto mt-5">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <button class="pl-4">
                                <Link :href="route('posts.index')">
                                    <Icon
                                        class="ml-2 lg:ml-8 font-medium text-4xl hover:bg-black hover:text-white rounded-2xl"
                                        icon="solar:round-arrow-left-outline"
                                    />
                                </Link>
                            </button>
                            <div
                                class="flex flex-col justify-center items-center mx-auto px-2 max-w-3xl"
                            >
                                <p class="text-xl font-bold mb-2">
                                    {{ post.title }}
                                </p>
                                <img
                                    v-if="post.image"
                                    class="rounded-lg h-64 sm:h-80 w-full object-cover mb-2"
                                    :src="`/storage/${post.image}`"
                                    alt="Image Post"
                                />
                                <img
                                    v-else
                                    class="rounded-lg h-64 sm:h-80 w-full object-cover mb-2"
                                    src="https://source.unsplash.com/800x500/?mountain"
                                    alt="news"
                                />
                                <p class="mb-2">{{ post.date_post }}</p>
                                <p>{{ post.body }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </DashboardLayout>
    </div>
</template>
