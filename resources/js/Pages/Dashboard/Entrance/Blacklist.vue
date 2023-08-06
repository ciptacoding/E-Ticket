<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { onMounted, ref } from "vue";

onMounted(() => {
    function multipleAttributes(element, attributes) {
        Object.keys(attributes).forEach((attr) => {
            element.setAttribute(attr, attributes[attr]);
        });
    }

    const attributes = {
        href: "https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css",
        rel: "stylesheet",
    };

    let selectLink = document.createElement("link");
    multipleAttributes(selectLink, attributes);
    document.head.appendChild(selectLink);

    let selectScript = document.createElement("script");
    selectScript.setAttribute(
        "src",
        "https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"
    );
    document.body.appendChild(selectScript);
});

const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    full_name: props.data.full_name,
    user_id: props.data.user_id,
    start_date: "",
    end_date: "",
    description: "",
});

const submit = () => {
    form.post("/blacklists");
};
</script>

<template>
    <div>
        <Head title="Dashboard | Create Blacklist" />

        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create Blacklist
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <button>
                                <Link :href="route('entrance.index')">
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
                                            for="user_id"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Select Username
                                        </label>
                                        <select
                                            id="user_id"
                                            data-te-select-init
                                            data-te-select-filter="true"
                                            v-model="form.user_id"
                                            disabled
                                        >
                                            <option value="-">
                                                Select username
                                            </option>
                                            <option
                                                :key="form.user_id"
                                                :value="form.user_id"
                                            >
                                                {{ props.data.username }}
                                            </option>
                                        </select>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.user_id"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="full_name"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Full Name
                                        </label>
                                        <input
                                            v-model="form.full_name"
                                            type="text"
                                            id="full_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Write your full name..."
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.full_name"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="start_date"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Start Date</label
                                        >
                                        <input
                                            v-model="form.start_date"
                                            type="date"
                                            id="start_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.start_date"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="end_date"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >End Date
                                        </label>
                                        <input
                                            v-model="form.end_date"
                                            type="date"
                                            id="end_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.end_date"
                                        />
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label
                                        for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Description</label
                                    >
                                    <textarea
                                        v-model="form.description"
                                        id="description"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write description here..."
                                    ></textarea>
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.description"
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
