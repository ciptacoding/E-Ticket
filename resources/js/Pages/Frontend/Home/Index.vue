<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import { Icon } from "@iconify/vue";
import NavbarWeb from "@/Components/NavbarWeb.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import Posts from "./Partials/Posts.vue";

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
            <!-- navbar mobile view -->
            <MobileNavbar />
            <!-- navbar mobile view -->

            <!-- header section -->
            <header
                class="bg-fixed bg-[url('/img/hero-image.jpg')] bg-cover h-[35rem] lg:h-screen"
            >
                <div
                    class="backdrop-opacity-10 backdrop-invert bg-black/40 bg-cover h-[35rem] w-full lg:h-screen"
                >
                    <!-- navbar web view -->
                    <NavbarWeb
                        :can-login="canLogin"
                        :can-register="canRegister"
                    />
                    <!-- navbar web view -->

                    <div class="px-4 sm:px-12 lg:px-28 flex flex-col">
                        <h1
                            class="mt-36 sm:mt-48 lg:mt-[14rem] mb-2 text-white text-2xl font-bold md:text-center md:w-9/12 md:mx-auto md:text-4xl lg:text-5xl xl:leading-[4rem]"
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
            <div class="px-4 sm:px-12 lg:px-28 mt-10">
                <h1
                    class="text-2xl font-bold sm:text-3xl mb-5 flex items-center"
                >
                    <Icon
                        class="text-2xl sm:text-3xl inline"
                        icon="solar:notebook-bold"
                    />
                    <span>Latest News</span>
                </h1>
                <Posts :posts="posts" />
                <Pagination
                    :links="posts.links"
                    :next_page_url="posts.next_page_url"
                    :prev_page_url="posts.prev_page_url"
                />
            </div>
            <!-- post section -->
        </div>
    </div>
</template>

<style></style>
