<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const form = useForm({
    title: "",
    image: "",
    date_post: "",
    excerpt: "",
    body: "",
});
</script>

<template>
    <div>
        <Head title="Dashboard | Create Post" />

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
                            <button>
                                <Link :href="route('posts.index')">
                                    <Icon
                                        class="ml-4 font-medium text-4xl hover:bg-black hover:text-white rounded-2xl"
                                        icon="solar:round-arrow-left-outline"
                                    />
                                </Link>
                            </button>

                            <form class="mx-8 my-5">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label
                                            for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Title
                                        </label>
                                        <input
                                            type="text"
                                            id="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Input Title"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="image"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Image</label
                                        >
                                        <input
                                            type="text"
                                            id="image"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Input Image"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="date_post"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Date
                                        </label>
                                        <input
                                            type="text"
                                            id="date_post"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Flowbite"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="excerpt"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Excerpt</label
                                        >
                                        <input
                                            type="tel"
                                            id="excerpt"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="123-45-678"
                                            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label
                                        for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Content</label
                                    >
                                    <textarea
                                        id="message"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
