<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    user_id: props.post.user_id,
    title: props.post.title,
    image: props.post.image,
    date_post: props.post.date_post,
    excerpt: props.post.excerpt,
    body: props.post.body,
});

const submit = () => {
    form.put(`/posts/${props.post.id}`);
};
</script>

<template>
    <div>
        <Head title="Dashboard | Edit Post" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Update Post
                </h2>
            </template>

            <div class="py-8">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <button>
                                <Link :href="route('posts.index')">
                                    <Icon
                                        class="ml-8 font-medium text-4xl hover:bg-black hover:text-white rounded-2xl"
                                        icon="solar:round-arrow-left-outline"
                                    />
                                </Link>
                            </button>

                            <form class="mx-8 my-5" @submit.prevent="submit">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label
                                            for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Title
                                        </label>
                                        <input
                                            v-model="form.title"
                                            type="text"
                                            id="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Write your title..."
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.title"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="image"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Image</label
                                        >
                                        <input
                                            @input="
                                                form.image =
                                                    $event.target.files[0]
                                            "
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                            aria-describedby="file_input_help"
                                            id="image"
                                            type="file"
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.image"
                                        />
                                        <progress
                                            v-if="form.progress"
                                            :value="form.progress.percentage"
                                            max="100"
                                        >
                                            {{ form.progress.percentage }}%
                                        </progress>
                                        <p
                                            class="mt-1 text-sm text-gray-500"
                                            id="file_input_help"
                                        >
                                            PNG, JPG, JPEG (MAX. 2MB).
                                        </p>
                                    </div>

                                    <div>
                                        <label
                                            for="date_post"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Date
                                        </label>
                                        <input
                                            v-model="form.date_post"
                                            type="date"
                                            id="date_post"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.date_post"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="excerpt"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Excerpt</label
                                        >
                                        <input
                                            v-model="form.excerpt"
                                            type="text"
                                            id="excerpt"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Write your excerpt..."
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.excerpt"
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
                                        v-model="form.body"
                                        id="message"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."
                                    ></textarea>
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.body"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="mr-4 flex items-center gap-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2"
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
