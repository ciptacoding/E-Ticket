<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import { Icon } from "@iconify/vue";
import NavbarWeb from "@/Components/NavbarWeb.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import Footer from "./Partials/Footer.vue";
import Posts from "./Partials/Posts.vue";
import Chart from "./Partials/Chart.vue";
import Comment from "./Partials/Comment.vue";
import { watch, ref } from "vue";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    posts: {
        type: Object,
    },
    blacklists: {
        type: Object,
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

let search = ref(props.filters.search);

watch(search, (value) => {
    router.get(
        "/",
        { search: value },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        }
    );
});

const truncateDescription = (blacklist) => {
    let description = stripTags(blacklist.description);
    return description.length > 20
        ? description.substring(0, 20) + "..."
        : description;
};

const stripTags = (text) => {
    return text.replace(/(<([^>]+)>)/gi, "");
};
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

            <!-- blacklist section -->
            <section class="px-4 sm:px-12 lg:px-28 mt-10">
                <h1
                    class="text-2xl font-bold sm:text-3xl mb-5 flex items-center"
                >
                    <Icon
                        class="text-2xl sm:text-3xl inline"
                        icon="solar:notebook-bold"
                    />
                    <span>Blacklist Information</span>
                </h1>
                <div class="max-w-7xl mx-auto">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <div class="mb-4 flex justify-between">
                                <input
                                    id="search"
                                    name="search"
                                    type="text"
                                    v-model="search"
                                    placeholder="Search..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-2/3 sm:w-2/4 lg:w-2/6 p-2.5 ml-4 h-[41px]"
                                />
                            </div>
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Full Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Start Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            End Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="blacklist in blacklists.data"
                                        :key="blacklist.id"
                                        class="bg-white border-b"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            {{ blacklist.full_name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ blacklist.start_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ blacklist.end_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ truncateDescription(blacklist) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :links="blacklists.links" />
                        </div>
                    </div>
                </div>
            </section>
            <!-- blacklist section -->

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
            <Footer />
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
