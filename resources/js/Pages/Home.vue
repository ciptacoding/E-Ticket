<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import NavbarLink from "@/Components/NavbarLink.vue";
import { computed } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    posts: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Mount Agung | Home" />
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- header section -->
            <header
                class="bg-fixed bg-[url('/img/hero-image.jpg')] bg-cover h-[35rem] lg:h-screen"
            >
                <div
                    class="backdrop-opacity-10 backdrop-invert bg-black/40 bg-cover h-[35rem] w-full lg:h-screen"
                >
                    <nav
                        class="absolute top-0 left-0 right-0 w-full bg-transparent"
                    >
                        <div
                            class="flex justify-between h-24 items-center px-8 sm:px-28"
                        >
                            <div class="justify-self-start">
                                <Link
                                    :href="route('home')"
                                    class="flex items-center gap-5"
                                >
                                    <ApplicationLogo
                                        class="block h-12 w-auto fill-current"
                                    />
                                    <p class="text-white text-xl font-semibold">
                                        E - Ticketing
                                    </p>
                                </Link>
                            </div>
                            <div class="justify-self-center">
                                <ul
                                    class="flex gap-10 text-white text-xl font-semibold"
                                >
                                    <NavbarLink
                                        :href="route('home')"
                                        :active="route().current('home')"
                                    >
                                        Home
                                    </NavbarLink>
                                    <NavbarLink
                                        :href="route('users.index')"
                                        :active="route().current('users.index')"
                                    >
                                        Quota
                                    </NavbarLink>
                                    <NavbarLink
                                        :href="route('users.index')"
                                        :active="route().current('users.index')"
                                    >
                                        Booking
                                    </NavbarLink>
                                    <NavbarLink
                                        :href="route('users.index')"
                                        :active="route().current('users.index')"
                                    >
                                        Suggestions
                                    </NavbarLink>
                                </ul>
                            </div>
                            <div class="justify-self-end text-xl">
                                <div v-if="canLogin">
                                    <template v-if="$page.props.auth.user">
                                        <div class="ml-3 relative">
                                            <Dropdown align="right" width="48">
                                                <template #trigger>
                                                    <span
                                                        class="inline-flex rounded-md"
                                                    >
                                                        <button
                                                            type="button"
                                                            class="font-semibold inline-flex items-center border border-transparent rounded-md text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                        >
                                                            {{
                                                                $page.props.auth
                                                                    .user.name
                                                            }}

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
                                                    <DropdownLink
                                                        :href="
                                                            route(
                                                                'profile.edit'
                                                            )
                                                        "
                                                    >
                                                        Profile
                                                    </DropdownLink>

                                                    <DropdownLink
                                                        v-if="
                                                            $page.props.auth
                                                                .user.role ===
                                                            'admin'
                                                        "
                                                        :href="
                                                            route('users.index')
                                                        "
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
                                        <Link
                                            :href="route('login')"
                                            class="font-semibold text-white"
                                        >
                                            Log in
                                        </Link>

                                        <Link
                                            v-if="canRegister"
                                            :href="route('register')"
                                            class="ml-4 font-semibold text-white"
                                        >
                                            Register
                                        </Link>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class="p-8 lg:px-28 flex flex-col">
                        <h1
                            class="mt-24 sm:mt-32 lg:mt-[14rem] mb-2 text-white text-2xl font-bold md:text-center md:w-9/12 md:mx-auto md:text-4xl lg:text-5xl xl:leading-[4rem]"
                        >
                            Mount Agung is a popular hiking destination for
                            adventurous travelers, offering stunning views of
                            the island from its summit.
                        </h1>
                        <div class="flex justify-center mt-6">
                            <button
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-lg px-5 py-2.5 text-center mr-2 mb-2"
                            >
                                Booking Now
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header section -->

            <!-- post section -->
            <div class="px-8 sm:px-28 mt-10">
                <div class="grid grid-cols-3">
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    >
                        <img class="rounded-t-lg" />

                        <div class="p-5">
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                            >
                                Noteworthy technology acquisitions 2021
                            </h5>

                            <p
                                class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                            >
                                Here are the biggest enterprise technology
                                acquisitions of 2021 so far, in reverse
                                chronological order.
                            </p>
                            <a
                                href="#"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Read more
                                <svg
                                    class="w-3.5 h-3.5 ml-2"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 14 10"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- post section -->
        </div>
    </div>
</template>

<style></style>
