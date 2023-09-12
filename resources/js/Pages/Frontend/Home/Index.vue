<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import { Icon } from "@iconify/vue";
import NavbarWeb from "@/Components/NavbarWeb.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import Footer from "@/Components/Footer.vue";
import Posts from "./Partials/Posts.vue";
import Chart from "./Partials/Chart.vue";
import Comment from "./Partials/Comment.vue";
import { watch, ref, onMounted } from "vue";

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
    suggestions: {
        type: Object,
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    total: {
        type: Number,
    },
    male: {
        type: Number,
    },
    female: {
        type: Number,
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
    return description.length > 40
        ? description.substring(0, 40) + "..."
        : description;
};

const stripTags = (text) => {
    return text.replace(/(<([^>]+)>)/gi, "");
};
</script>

<template>
    <Head title="Mount Agung | Home" />
    <div>
        <div class="min-h-screen bg-gray-50">
            <!-- navbar mobile view -->
            <MobileNavbar />
            <!-- navbar mobile view -->

            <!-- navbar web view -->
            <NavbarWeb :can-login="canLogin" :can-register="canRegister" />
            <!-- navbar web view -->

            <!-- header section -->
            <header
                class="bg-fixed bg-[url('/img/heronew.png')] bg-cover h-screen"
            >
                <div class="bg-cover h-[35rem] w-full lg:h-screen">
                    <div
                        class="max-w-screen-xl mx-auto my-auto h-screen px-4 sm:px-6 lg:px-8 flex flex-col justify-center"
                    >
                        <h1
                            class="mb-2 text-white text-2xl lg:text-5xl font-bold lg:w-2/3"
                        >
                            <img src="/img/line.png" alt="" />
                            Mount Agung is a popular destination for adventurous
                            travelers who want to climb it and enjoy the
                            stunning views from its summit.
                        </h1>
                        <div class="mt-8">
                            <div
                                class="mb-2 grid grid-cols-4 w-full md:w-2/3 py-2 bg-white bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-30 rounded-md divide-x-2 text-xs sm:text-base"
                            >
                                <button class="text-gray-200 text-center">
                                    Fast Payment
                                </button>
                                <button class="text-gray-200 text-center">
                                    Online Ticket
                                </button>
                                <button class="text-gray-200 text-center">
                                    Secured Data
                                </button>
                                <Link
                                    class="text-center"
                                    :href="route('booking.index')"
                                >
                                    <button
                                        class="rounded-md text-white bg-[#DF6951] px-2 py-2 sm:px-4"
                                    >
                                        Book Now
                                    </button>
                                </Link>
                            </div>
                            <img src="/img/clients.png" alt="client" />
                        </div>
                    </div>
                </div>
            </header>
            <!-- header section -->

            <!-- service -->
            <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
                <h1 class="text-[#DF6951] text-center font-extrabold">
                    CATEGORY
                </h1>
                <h1
                    class="text-gray-800 text-center text-2xl sm:text-3xl font-extrabold"
                >
                    We Offer Best Services
                </h1>
                <div
                    class="grid grid-cols-2 md:grid-cols-4 gap-10 justify-center mt-6"
                >
                    <div class="flex flex-col items-center justify-self-center">
                        <img
                            src="/img/tour-guide.png"
                            class="w-12"
                            alt="tour"
                        />
                        <h1 class="text-center text-xs sm:text-base font-bold">
                            Guided Tours
                        </h1>
                        <p class="text-center text-xs sm:text-base">
                            our guides possess in depth knowledge of the
                            terrain.
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-self-center">
                        <img
                            src="/img/travelling-1.png"
                            class="w-12"
                            alt="travel"
                        />
                        <h1 class="text-center text-xs sm:text-base font-bold">
                            Best Schedule Options
                        </h1>
                        <p class="text-center text-xs sm:text-base">
                            We have a flexible schedule, it all depends on the
                            client.
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-self-center">
                        <img src="/img/hands.png" class="w-14" alt="hands" />
                        <h1 class="text-center text-xs sm:text-base font-bold">
                            Religious Tours
                        </h1>
                        <p class="text-center text-xs sm:text-base">
                            We also have religious tours, especially Besakih
                            temple.
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-self-center">
                        <img
                            src="/img/medical-team.png"
                            class="w-14"
                            alt="medical"
                        />
                        <h1 class="text-center text-xs sm:text-base font-bold">
                            Medical Insurance
                        </h1>
                        <p class="text-center text-xs sm:text-base">
                            Our medical team is always ready to help travelers.
                        </p>
                    </div>
                </div>
            </section>
            <!-- service -->

            <!-- Activity Section -->
            <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
                <div class="grid grid-cols-1 md:grid-cols-3 items-center mb-4">
                    <img
                        src="/img/human-fix.png"
                        alt="trekking"
                        class="w-[299px] sm:w-[399px]"
                    />
                    <div class="col-span-2">
                        <h1
                            class="font-bold text-[#DF6951] text-lg md:text-xl text-center"
                        >
                            Current Climbing Conditions
                        </h1>
                        <p
                            class="text-center mx-auto md:w-2/4 text-sm md:text-base"
                        >
                            The following is real-time data and graphical
                            comparison of visitors to Mount Agung.
                        </p>
                        <div class="grid grid-cols-1">
                            <div
                                class="flex gap-5 sm:gap-10 md:gap-14 justify-center mb-2"
                            >
                                <div class="flex items-center gap-1">
                                    <Icon
                                        icon="et:profile-male"
                                        class="text-4xl"
                                    />
                                    <h1>
                                        {{ props.total }}<br />
                                        Total
                                    </h1>
                                </div>
                                <div class="flex items-center gap-1">
                                    <Icon
                                        icon="et:profile-male"
                                        class="text-4xl"
                                    />
                                    <h1>
                                        {{ props.male }} <br />
                                        Male
                                    </h1>
                                </div>
                                <div class="flex items-center gap-1">
                                    <Icon
                                        icon="et:profile-female"
                                        class="text-4xl"
                                    />
                                    <h1>
                                        {{ props.female }} <br />
                                        Female
                                    </h1>
                                </div>
                            </div>
                            <div class="flex justify-center md:w-2/3 mx-auto">
                                <Chart
                                    :female="props.female"
                                    :male="props.male"
                                    :total="props.total"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Activity Section -->

            <!-- post section -->
            <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
                <h1
                    class="text-2xl text-[#DF6951] font-bold md:text-3xl text-center"
                >
                    LATEST NEWS
                </h1>
                <p
                    class="text-gray-900 mx-auto md:w-2/5 text-base text-center mb-4"
                >
                    The latest news that provides up-to-date information for
                    visitors who are interested in mountaineering.
                </p>
                <Posts :posts="posts" />
                <Pagination
                    :links="posts.links"
                    :next_page_url="posts.next_page_url"
                    :prev_page_url="posts.prev_page_url"
                />
            </section>
            <!-- post section -->
            <section
                class="mt-20 w-full bg-[url('/img/Explore-Nature.png')] h-[200px] md:h-[400px] bg-cover bg-center"
            ></section>
            <!-- blacklist section -->
            <section
                class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mt-[-4rem] z-20"
            >
                <div
                    class="bg-white p-8 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-50 shadow-md"
                >
                    <h1
                        class="text-base text-center text-[#DF6951] font-bold sm:text-2xl"
                    >
                        BLACKLIST INFORMATION
                    </h1>
                    <p
                        class="mb-5 text-center mx-auto md:w-2/5 text-gray-900 text-base"
                    >
                        Here is a blacklist of some climbers who have violated
                        the rules and regulations during the climbing
                        expedition.
                    </p>
                    <div class="w-full mx-auto">
                        <div class="relative overflow-x-auto rounded-md py-6">
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
                                            Username
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
                                            {{ blacklist.user.name }}
                                        </td>
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
            <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mt-28">
                <div class="mb-32">
                    <h1 class="text-base text-[#DF6951] font-bold text-center">
                        COMMENT FROM USERS
                    </h1>
                    <p
                        class="text-2xl font-bold mb-5 text-gray-900 text-center mx-auto md:w-2/5"
                    >
                        "See What Our Clients Say About Us"
                    </p>
                    <Comment :suggestions="suggestions" />
                </div>
            </section>
            <!-- comment Section -->

            <!-- footer -->
            <Footer />
            <!-- footer -->
        </div>
    </div>
</template>

<style></style>
