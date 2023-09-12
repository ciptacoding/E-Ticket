<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import NavbarLink from "@/Components/NavbarLink.vue";
import { ref, onMounted } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

// const isNavbarFixed = ref(false);
// const textBlack = ref(false);

// const handleScroll = () => {
//     if (window.scrollY > 40) {
//         isNavbarFixed.value = true;
//         textBlack.value = true;
//     } else {
//         isNavbarFixed.value = false;
//         textBlack.value = false;
//     }
// };

// onMounted(() => {
//     window.addEventListener("scroll", handleScroll);
// });
</script>

<template>
    <div>
        <nav
            class="absolute top-0 left-0 right-0 w-full bg-transparent z-50 ease-in-out duration-500 mt-5"
        >
            <div
                class="grid grid-cols-3 justify-between h-20 items-center max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8"
            >
                <div class="justify-self-start items-self-end">
                    <Link :href="route('home')" class="flex items-end mt-2">
                        <ApplicationLogo
                            class="block h-12 md:h-14 w-auto fill-current"
                        />
                    </Link>
                </div>
                <div
                    class="col-span-2 justify-self-end flex items-center gap-10"
                >
                    <div class="hidden lg:block items-center">
                        <ul
                            class="flex gap-10 text-white text-lg font-semibold"
                        >
                            <NavbarLink
                                :href="route('home')"
                                :active="route().current('home')"
                                class="hover:text-gray-400"
                            >
                                Home
                            </NavbarLink>
                            <NavbarLink
                                :href="route('booking.index')"
                                :active="route().current('booking.index')"
                                class="hover:text-gray-400"
                            >
                                Booking
                            </NavbarLink>

                            <NavbarLink
                                :href="route('quota.index')"
                                :active="route().current('quota.index')"
                                class="hover:text-gray-400"
                            >
                                Quota
                            </NavbarLink>
                            <NavbarLink
                                :href="route('suggestion.index')"
                                :active="route().current('suggestion.index')"
                                class="hover:text-gray-400"
                            >
                                Suggestions
                            </NavbarLink>
                        </ul>
                    </div>
                    <div class="justify-self-end text-sm md:text-base">
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
                                                    class="md:font-semibold inline-flex items-center border border-transparent rounded-md text-white bg-[#DF6951] px-4 py-2"
                                                >
                                                    {{
                                                        $page.props.auth.user
                                                            .name
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
                                                :href="route('profile.edit')"
                                            >
                                                Profile
                                            </DropdownLink>

                                            <DropdownLink
                                                v-if="
                                                    $page.props.auth.user
                                                        .role === 'admin'
                                                "
                                                :href="
                                                    route('dashboard.detail')
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
                                    class="font-semibold text-white border border-white hover:border-none hover:bg-[#DF6951] px-4 py-2 rounded-md"
                                >
                                    Log in
                                </Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="ml-4 font-semibold text-white bg-[#DF6951] px-4 py-2 rounded-md"
                                >
                                    Register
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
