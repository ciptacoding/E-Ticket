<script setup>
import NavbarOther from "@/Components/NavbarOther.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import { Head } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    booking: {
        type: Object,
    },
});

const download = () => {
    window.html2canvas = html2canvas;
    var doc = new jsPDF("p", "pt", "a3");
    doc.html(document.querySelector("#tiket"), {
        callback: function (pdf) {
            pdf.save("tiket.pdf");
        },
    });
};
</script>

<template>
    <Head title="Mount Agung | Booking" />
    <div>
        <div class="bg-gray-100 min-h-screen relative">
            <!-- navbar mobile view -->
            <MobileNavbar />
            <!-- navbar mobile view -->
            <NavbarOther :can-login="canLogin" :can-register="canRegister" />

            <div class="pt-32 lg:pt-44">
                <div
                    class="w-full lg:w-[1050px] mx-auto px-4 sm:px-12 lg:px-28"
                >
                    <button
                        @click="download"
                        class="flex items-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-4"
                    >
                        Download PDF
                    </button>
                    <div class="shadow-md rounded-md" id="tiket">
                        <div
                            class="relative overflow-x-auto p-3 sm:p-6 bg-[#3d5652]"
                        >
                            <div class="bg-white rounded-lg">
                                <div
                                    class="grid grid-cols-1 lg:grid-cols-3 p-2 lg:gap-2 xl:gap-4"
                                >
                                    <div
                                        class="flex flex-col items-center mb-8"
                                    >
                                        <p
                                            class="text-xs text-gray-400 mb-5 xl:text-lg"
                                        >
                                            Mountain Climbing
                                        </p>
                                        <h1
                                            class="text-[#3d5652] text-2xl font-bold xl:text-3xl"
                                        >
                                            E-Ticket
                                        </h1>
                                        <h1
                                            class="text-[#3d5652] text-2xl font-bold xl:text-3xl"
                                        >
                                            Agung Mountain
                                        </h1>
                                        <p
                                            class="bg-yellow-500 px-4 py-2 text-white text-xs xl:text-sm rounded-lg mt-5"
                                        >
                                            Check-In {{ booking.check_in }}
                                        </p>
                                        <p
                                            class="bg-yellow-500 px-4 py-2 text-white text-xs xl:text-sm rounded-lg mt-2"
                                        >
                                            Check-Out {{ booking.check_out }}
                                            <br />
                                        </p>
                                    </div>
                                    <div class="flex flex-col mb-8">
                                        <h1
                                            class="text-center text-lg xl:text-xl text-gray-500 font-bold mb-2"
                                        >
                                            Customer Identity
                                        </h1>
                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Order ID : {{ booking.id }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Full Name : {{ booking.full_name }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Username : {{ booking.username }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Email : {{ booking.email }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Address : {{ booking.address }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Phone : {{ booking.phone }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Gender : {{ booking.gender }}
                                        </p>

                                        <p
                                            class="text-xs xl:text-base text-gray-500"
                                        >
                                            Status : {{ booking.status }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h1
                                            class="text-center text-lg xl:text-xl text-gray-500 font-bold"
                                        >
                                            Information
                                        </h1>
                                        <p
                                            class="text-sm xl:text-base text-gray-700"
                                        >
                                            1. This ticket must be shown to the
                                            officer at check-in and check-out.
                                        </p>
                                        <p
                                            class="text-sm xl:text-base text-gray-700"
                                        >
                                            2. This ticket is valid for one
                                            person, one climb.
                                        </p>
                                        <p
                                            class="text-sm xl:text-base text-gray-700"
                                        >
                                            3. Emergency Call : 085858038176
                                        </p>
                                        <p
                                            class="text-sm xl:text-base text-gray-700"
                                        >
                                            4. Insurance : First Aid Kit &
                                            Evacuation
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Footer class="bottom-0 lg:absolute sm:block w-full" />
        </div>
    </div>
</template>

<style scoped></style>
