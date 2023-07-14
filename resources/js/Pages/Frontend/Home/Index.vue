<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import { Icon } from "@iconify/vue";
import NavbarWeb from "@/Components/NavbarWeb.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import Posts from "./Partials/Posts.vue";
import Chart from "./Partials/Chart.vue";
import Comment from "./Partials/Comment.vue";

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

            <!-- Activity Section -->
            <section class="px-4 sm:px-12 lg:px-28 mt-10">
                <div class="flex flex-col items-center mb-4">
                    <img
                        src="/img/trekking.png"
                        alt="trekking"
                        class="w-[299px] sm:w-[399px]"
                    />
                    <h1 class="font-bold text-lg md:text-xl text-center">
                        Current Climbing Conditions
                    </h1>
                    <p class="text-center text-sm md:text-base">
                        The following is real-time data and graphical comparison
                        of visitors to Mount Agung.
                    </p>
                </div>
                <div class="grid grid-cols-1">
                    <div
                        class="flex gap-5 sm:gap-10 md:gap-14 justify-center mb-2"
                    >
                        <div class="flex items-center gap-1">
                            <Icon icon="et:profile-male" class="text-4xl" />
                            <h1>
                                749 <br />
                                Total
                            </h1>
                        </div>
                        <div class="flex items-center gap-1">
                            <Icon icon="et:profile-male" class="text-4xl" />
                            <h1>
                                478 <br />
                                Male
                            </h1>
                        </div>
                        <div class="flex items-center gap-1">
                            <Icon icon="et:profile-female" class="text-4xl" />
                            <h1>
                                271 <br />
                                Female
                            </h1>
                        </div>
                    </div>
                    <div class="flex justify-center md:w-2/4 mx-auto">
                        <Chart />
                    </div>
                </div>
            </section>
            <!-- Activity Section -->

            <!-- post section -->
            <section class="px-4 sm:px-12 lg:px-28 mt-10">
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
            </section>
            <!-- post section -->

            <!-- comment section -->
            <section class="px-4 sm:px-12 lg:px-28 mt-10">
                <h1
                    class="text-2xl font-bold sm:text-3xl mb-5 flex gap-2 items-center"
                >
                    <Icon
                        class="text-2xl sm:text-3xl inline"
                        icon="solar:chat-line-bold"
                    />
                    <span>Comment From Users</span>
                </h1>
                <Comment />
            </section>
            <!-- comment Section -->

            <!-- footer -->
            <!-- <section>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63157.250638938305!2d115.42681237730598!3d-8.369343796767494!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd21de884ee574b%3A0xb964752c9cf9e475!2sBase%20Camp%20Gunung%20Agung%20Via%20Edelweis!5e0!3m2!1sid!2sid!4v1689256382568!5m2!1sid!2sid"
                    class="w-full h-[400px] sm:h-[500px]"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </section> -->
            <!-- footer -->
        </div>
    </div>
</template>

<style></style>
