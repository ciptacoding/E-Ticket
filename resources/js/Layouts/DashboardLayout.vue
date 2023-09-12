<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import { Icon } from "@iconify/vue";

const showingNavigationDropdown = ref(false);
const sidebarOpen = ref(false);
const dropdownOpen = ref(false);
</script>

<template>
    <div>
        <!-- component -->
        <div>
            <div class="flex h-screen bg-gray-200">
                <div
                    :class="{ block: sidebarOpen, hidden: !sidebarOpen }"
                    @click="sidebarOpen = false"
                    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"
                ></div>

                <div
                    :class="{
                        'translate-x-0 ease-out': sidebarOpen,
                        '-translate-x-full ease-in': !sidebarOpen,
                    }"
                    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0"
                >
                    <div class="flex items-center justify-center mt-8">
                        <Link :href="route('home')">
                            <ApplicationLogo />
                        </Link>
                    </div>

                    <!-- navbar -->
                    <nav class="mt-10 flex flex-col justify-between h-[75vh]">
                        <div
                            v-if="$page.props.auth.user.role === 'admin'"
                            class="flex flex-col px-10 gap-6"
                        >
                            <NavLink
                                :href="route('dashboard.detail')"
                                :active="route().current('dashboard.detail')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:clipboard-list-bold"
                                    color="#ffffff"
                                    height="24"
                                />
                                <span>Overview</span>
                            </NavLink>

                            <NavLink
                                :href="route('users.index')"
                                :active="route().current('users.index')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:users-group-two-rounded-bold"
                                    color="#ffffff"
                                    height="24"
                                />
                                <span>Users</span>
                            </NavLink>

                            <NavLink
                                :href="route('posts.index')"
                                :active="route().current('posts.index')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:document-add-bold"
                                    color="#ffffff"
                                    height="22"
                                />
                                <span>Posts</span>
                            </NavLink>
                            <NavLink
                                :href="route('blacklists.index')"
                                :active="route().current('blacklists.index')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:user-block-bold"
                                    color="#ffffff"
                                    width="22"
                                />
                                <span>Blacklists</span>
                            </NavLink>
                            <NavLink
                                :href="route('transaction.index')"
                                :active="route().current('transaction.index')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:ticket-sale-bold"
                                    color="#ffffff"
                                    width="23"
                                />
                                <span>Transactions</span>
                            </NavLink>
                            <NavLink
                                :href="route('entrance.index')"
                                :active="route().current('entrance.index')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:checklist-minimalistic-bold"
                                    color="#ffffff"
                                    width="23"
                                />
                                <span>Entrances</span>
                            </NavLink>
                            <NavLink
                                :href="route('suggestions.index')"
                                :active="route().current('suggestions.index')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:wallet-bold"
                                    color="#ffffff"
                                    width="23"
                                />
                                <span>Suggestions</span>
                            </NavLink>
                        </div>
                        <div
                            v-if="$page.props.auth.user.role === 'user'"
                            class="flex flex-col px-10 gap-8"
                        >
                            <NavLink
                                :href="route('profile.edit')"
                                :active="route().current('profile.edit')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:user-bold"
                                    color="#ffffff"
                                    width="21"
                                />
                                <span>Profile</span>
                            </NavLink>
                            <NavLink
                                :href="route('home')"
                                :active="route().current('home')"
                                class="flex gap-2"
                            >
                                <Icon
                                    icon="solar:home-2-bold"
                                    color="#ffffff"
                                    width="22"
                                />
                                <span>Homepage</span>
                            </NavLink>
                        </div>
                        <div class="pl-14">
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="mt-10"
                            >
                                <button
                                    class="border border-white px-6 py-1 hover:bg-[#DF6951] text-white rounded-md text-lg font-semibold flex gap-2 items-center"
                                >
                                    <Icon
                                        icon="solar:double-alt-arrow-left-linear"
                                        color="#ffffff"
                                        width="22"
                                    />
                                    <span>Logout</span>
                                </button>
                            </Link>
                        </div>
                    </nav>
                </div>
                <div class="flex flex-col flex-1 overflow-hidden">
                    <header
                        class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-[#DF6951]"
                    >
                        <div class="flex items-center">
                            <button
                                @click="sidebarOpen = true"
                                class="text-gray-500 focus:outline-none lg:hidden"
                            >
                                <svg
                                    class="w-6 h-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M4 6H20M4 12H20M4 18H11"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                </svg>
                            </button>

                            <div class="relative mx-4 lg:mx-0">
                                <div
                                    v-if="
                                        $page.props.auth.user.role === 'admin'
                                    "
                                >
                                    <slot name="searching" />
                                </div>
                                <div
                                    v-if="$page.props.auth.user.role === 'user'"
                                >
                                    <h1
                                        class="text-xl text-[#DF6951] font-bold"
                                    >
                                        Edit Profile
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <!-- profile dropdown -->
                        <div class="flex items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-4 py-3 border border-transparent text-xs sm:text-sm leading-4 font-medium rounded-md text-white bg-[#DF6951] hover:text-gray-800 focus:outline-none transition ease-in-out duration-150"
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
                                        <DropdownLink
                                            v-if="
                                                $page.props.auth.user.role ===
                                                'admin'
                                            "
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink :href="route('home')">
                                            Homepage
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
                        </div>
                    </header>
                    <main
                        class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200"
                    >
                        <div class="container px-6 py-8 mx-auto">
                            <h3 class="text-3xl font-medium text-gray-700">
                                <slot name="title" />
                            </h3>

                            <slot name="main" />
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
