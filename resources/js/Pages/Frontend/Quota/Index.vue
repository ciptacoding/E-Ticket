<script setup>
import NavbarOther from "@/Components/NavbarOther.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import InputError from "@/Components/InputError.vue";
import { Icon } from "@iconify/vue";
import { ref, computed, onMounted } from "vue";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    data: {
        type: Number,
    },
    quota: {
        type: Number,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    check_in_date: "",
});

const submit = () => {
    form.post("/quota");
};

const APIKey = "a1407d426a38581b29783294a5163b66";
const city = ref("Besakih");

const weatherData = ref(null);

const formattedTemperature = computed(() => {
    if (weatherData.value) {
        return `${parseInt(weatherData.value.main.temp)}<span>°C</span>`;
    }
    return "";
});

const weatherIcon = computed(() => {
    if (weatherData.value) {
        switch (weatherData.value.weather[0].main) {
            case "Clear":
                return "/img/clear.png";
            case "Rain":
                return "/img/rain.png";
            case "Snow":
                return "/img/snow.png";
            case "Clouds":
                return "/img/cloud.png";
            case "Haze":
                return "/img/mist.png";
            default:
                return "";
        }
    }
    return "";
});

const searchWeather = async () => {
    if (!city.value) {
        return;
    }

    try {
        const response = await fetch(
            `https://api.openweathermap.org/data/2.5/weather?q=${city.value}&units=metric&appid=${APIKey}`
        );
        const json = await response.json();
        // console.log(json);

        if (json.cod === "404") {
            weatherData.value = null;
        } else {
            weatherData.value = json;
        }
    } catch (error) {
        console.error("Error fetching weather data:", error);
        weatherData.value = null;
    }
};

onMounted(searchWeather);
</script>

<template>
    <Head title="Mount Agung | Quota" />
    <div>
        <div class="bg-gray-100 min-h-screen relative">
            <!-- navbar mobile view -->
            <MobileNavbar />
            <!-- navbar mobile view -->
            <NavbarOther :can-login="canLogin" :can-register="canRegister" />

            <div class="pt-32 lg:pt-44">
                <div class="w-full mx-auto px-4 sm:px-12 lg:px-28">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <form
                                    class="mx-8 my-5 items-center"
                                    @submit.prevent="submit"
                                >
                                    <div class="grid gap-6 mb-2 grid-cols-1">
                                        <div>
                                            <h1
                                                class="text-center text-xl font-bold mb-2 lg:mb-4"
                                            >
                                                Quota And Weather
                                            </h1>
                                            <h1 class="text-sm text-gray-500">
                                                Note: Please confirm your
                                                check-in date and make sure it's
                                                still available before ordering
                                                tickets online.
                                            </h1>
                                        </div>
                                        <div>
                                            <label
                                                for="check-in"
                                                class="block mb-2 text-sm font-medium text-gray-900"
                                            >
                                                Check In Date
                                            </label>
                                            <input
                                                v-model="form.check_in_date"
                                                type="date"
                                                id="check-in"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Write your comment..."
                                                required
                                            />
                                            <InputError
                                                class="mt-2"
                                                :message="form.errors.comment"
                                            />
                                        </div>

                                        <div class="mb-4">
                                            <table
                                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-200"
                                            >
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                                >
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-3 sm:px-6 py-3"
                                                        >
                                                            Quota
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-3 sm:px-6 py-3"
                                                        >
                                                            Used
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-3 sm:px-6 py-3 text-center"
                                                        >
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        class="bg-white border-b"
                                                    >
                                                        <td class="px-6 py-4">
                                                            {{ props.quota }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ props.data }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 flex justify-center"
                                                        >
                                                            {{ props.status }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <button
                                        type="submit"
                                        class="mr-4 flex items-center gap-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-8 py-2.5 text-center mb-2"
                                    >
                                        Check
                                    </button>
                                </form>

                                <div
                                    class="mx-8 my-5 flex flex-col items-center"
                                >
                                    <div
                                        class="flex items-center w-full xl:w-2/3"
                                    >
                                        <div
                                            class="relative w-full flex items-center"
                                        >
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                            >
                                                <Icon
                                                    icon="solar:map-point-linear"
                                                    width="24"
                                                    height="24"
                                                />
                                            </div>
                                            <input
                                                v-model="city"
                                                @keyup.enter="searchWeather"
                                                type="text"
                                                id="city-search"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm sm:text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-center"
                                                placeholder="Search city name..."
                                                required
                                            />
                                            <button
                                                @click="searchWeather"
                                                class="absolute inset-y-0 right-0 flex items-center pr-3"
                                            >
                                                <svg
                                                    class="w-4 h-4 sm:w-6 sm:h-6"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div v-if="weatherData" class="weather-box">
                                        <img
                                            :src="weatherIcon"
                                            alt="Weather Icon"
                                            class="w-48 md:w-60"
                                        />

                                        <div
                                            class="text-center font-bold text-2xl mt-2"
                                            v-html="formattedTemperature"
                                        ></div>
                                        <div
                                            class="text-center capitalize text-xl"
                                        >
                                            {{
                                                weatherData.weather[0]
                                                    .description
                                            }}
                                        </div>
                                    </div>
                                    <div
                                        v-if="city && !weatherData"
                                        class="not-found"
                                    >
                                        <p class="text-center mt-4">
                                            City not found
                                        </p>

                                        <img
                                            src="/img/404.png"
                                            alt="Weather Icon"
                                        />
                                    </div>
                                    <div
                                        v-if="weatherData"
                                        class="flex gap-12 md:gap-16 xl:gap-20 mt-8"
                                    >
                                        <div class="flex items-center">
                                            <Icon
                                                icon="material-symbols:water"
                                                class="mr-2"
                                                height="28"
                                                width="28"
                                            />
                                            <div class="flex flex-col">
                                                <span
                                                    >{{
                                                        weatherData.main
                                                            .humidity
                                                    }}%</span
                                                >
                                                <p class="text-sm">Humidity</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <Icon
                                                icon="material-symbols:air"
                                                class="mr-2"
                                                height="28"
                                                width="28"
                                            />
                                            <div class="flex flex-col">
                                                <span
                                                    >{{
                                                        weatherData.wind.speed
                                                    }}Km/h</span
                                                >
                                                <p class="text-sm">Wind</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Footer class="bottom-0 w-full" />
        </div>
    </div>
</template>
