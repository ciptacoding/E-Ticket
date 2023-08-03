<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import NavbarLinkOther from "@/Components/NavbarLinkOther.vue";

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
    <div>
        <nav class="absolute top-0 left-0 right-0 w-full bg-white z-50">
            <div
                class="flex justify-between h-24 items-center px-4 sm:px-12 lg:px-28"
            >
                <div class="justify-self-start">
                    <Link
                        :href="route('home')"
                        class="flex items-center gap-2 md:gap-5"
                    >
                        <ApplicationLogo
                            class="block h-8 md:h-12 w-auto fill-current"
                        />
                        <p
                            class="text-base text-gray-700 md:text-xl md:font-semibold"
                        >
                            E - Ticketing
                        </p>
                    </Link>
                </div>
                <div class="hidden lg:block justify-self-center">
                    <ul class="flex gap-10 text-xl font-semibold">
                        <NavbarLinkOther
                            :href="route('home')"
                            :active="route().current('home')"
                        >
                            Home
                        </NavbarLinkOther>
                        <NavbarLinkOther
                            :href="route('booking.index')"
                            :active="route().current('booking.index')"
                        >
                            Booking
                        </NavbarLinkOther>
                        <NavbarLinkOther
                            :href="route('users.index')"
                            :active="route().current('users.index')"
                        >
                            Quota
                        </NavbarLinkOther>
                        <NavbarLinkOther
                            :href="route('suggestion.index')"
                            :active="route().current('suggestion.index')"
                        >
                            Suggestions
                        </NavbarLinkOther>
                    </ul>
                </div>
                <div class="justify-self-end text-sm md:text-xl">
                    <div v-if="canLogin">
                        <template v-if="$page.props.auth.user">
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="md:font-semibold inline-flex items-center border border-transparent rounded-md text-gray-700 focus:outline-none transition ease-in-out duration-150"
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
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink
                                            v-if="
                                                $page.props.auth.user.role ===
                                                'admin'
                                            "
                                            :href="route('users.index')"
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
                                class="font-semibold text-gray-700"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="ml-4 font-semibold text-gray-700"
                            >
                                Register
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
