<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Mount Agung | Home" />

    <div
        v-if="canLogin"
        class="sm:fixed sm:top-0 sm:left-0 sm:right-0 p-6 text-right bg-white shadow"
    >
        <template v-if="$page.props.auth.user">
            <div class="ml-3 relative">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ $page.props.auth.user.name }}

                                <svg
                                    class="ml-2 -mr-0.5 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')">
                            Profile
                        </DropdownLink>

                        <DropdownLink
                            v-if="$page.props.auth.user.role === 'admin'"
                            :href="route('dashboard')"
                        >
                            Dashboard
                        </DropdownLink>

                        <DropdownLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </template>

        <template v-else>
            <Link :href="route('login')" class="font-semibold text-gray-900">
                Log in
            </Link>

            <Link
                v-if="canRegister"
                :href="route('register')"
                class="ml-4 font-semibold text-gray-900"
            >
                Register
            </Link>
        </template>
    </div>
    <div class="min-h-screen bg-gray-100">
        <div class="pt-64 mx-auto p-6">
            <h1 class="text-gray-900">Frontend Coming Soon</h1>
        </div>
    </div>
</template>

<style></style>
