<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
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
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Show Detail Post
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <img
                                :src="`/storage/${post.image}`"
                                alt="Image Post"
                            />
                            <p>{{ post.title }}</p>
                            <p>{{ post.date_post }}</p>
                            <p>{{ post.body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
