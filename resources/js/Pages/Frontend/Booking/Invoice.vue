<script setup>
import NavbarOther from "@/Components/NavbarOther.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import VueQrcode from "@chenfengyuan/vue-qrcode";

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
    bookingNumber: {
        type: String,
    }
});

const value = props.bookingNumber;
console.log(value.toString())

const download = async () => {
    try {
        // Dynamically import html2canvas and jspdf
        const { default: html2canvas } = await import("html2canvas");
        const { default: jsPDF } = await import("jspdf");

        // Assign html2canvas to the window object so that it is available globally
        window.html2canvas = html2canvas;

        // Create the jsPDF instance
        const doc = new jsPDF("l", "pt", "a4");

        // Wait for html2canvas to be available globally
        await new Promise((resolve) => setTimeout(resolve, 100));

        // Perform the document rendering once html2canvas is available
        doc.html(document.querySelector("#tiket"), {
            callback: function (pdf) {
                pdf.save("tiket.pdf");
            },
        });
    } catch (error) {
        console.error("Error while dynamically importing modules:", error);
    }
};
</script>

<template>
    <Head title="Mount Agung | Booking" />
    <div>
        <div class="bg-gray-50 min-h-screen relative">
            <!-- navbar mobile view -->
            <MobileNavbar />
            <!-- navbar mobile view -->
            <NavbarOther :can-login="canLogin" :can-register="canRegister" />

            <div
                class="pt-28 lg:py-32 overflow-x-scroll min-[800px]:overflow-x-hidden"
            >
                <div
                    class="max-w-[890px] mx-auto px-4 sm:px-6 w-[800px] lg:w-[890px]"
                >
                    <button
                        @click="download"
                        class="flex items-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-4"
                    >
                        Download PDF
                    </button>
                    <div class="shadow-lg rounded-md" id="tiket">
                        <div
                            class="relative overflow-x-auto p-3 sm:p-6 bg-white"
                        >
                            <div class="relative">
                                <img
                                    src="/img/background-tikets.jpg"
                                    alt=""
                                    class="bg-cover object-cover h-80 w-full"
                                />
                                <div
                                    class="backdrop-opacity-10 backdrop-invert absolute top-0 left-0 right-0 bottom-0 p-4"
                                >
                                    <div class="flex justify-between">
                                        <img
                                            src="/img/Logo-org-bsk.png"
                                            alt="logo"
                                            class="w-12 h-12"
                                        />
                                        <img
                                            src="/img/logo-besakih.png"
                                            alt="logo"
                                            class="w-12 h-12"
                                        />
                                        <vue-qrcode
                                            :value="value"
                                            :options="{ width: 70 }"
                                        ></vue-qrcode>
                                    </div>
                                    <div>
                                        <h1
                                            class="text-center text-xl tracking-wide font-bold text-[#facc15]"
                                        >
                                            PENDAKIAN GUNUNG AGUNG BESAKIH
                                        </h1>
                                        <h1
                                            class="underline text-center text-2xl font-bold text-white tracking-wide"
                                        >
                                            TIKET MASUK
                                        </h1>
                                    </div>
                                    <div
                                        class="mt-2 grid grid-cols-3 gap-4 justify-between"
                                    >
                                        <div class="text-white">
                                            <p
                                                class="text-xs text-black w-9/12 px-1 mb-1 pb-1 border border-black bg-white"
                                            >
                                                No. {{ booking.id }}
                                            </p>
                                            <p class="font-extralight text-sm">
                                                Check-In {{ booking.check_in }}
                                            </p>
                                        </div>
                                        <div
                                            class="text-white text-center font-semibold"
                                        >
                                            {{ booking.full_name }}
                                            <p class="font-light text-sm mt-2">
                                                Check-Out
                                                {{ booking.check_out }}
                                            </p>
                                        </div>
                                        <div
                                            class="relative justify-self-end pr-4"
                                        >
                                            <img
                                                src="/img/doorprices.png"
                                                alt="doorprice"
                                                class="w-32"
                                            />
                                            <h1
                                                class="absolute top-5 pb-1 text-white text-2xl font-bold"
                                            >
                                                Rp. 25.000
                                            </h1>
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-3 gap-8 justify-between"
                                    >
                                        <div>
                                            <p
                                                class="text-white font-bold tracking-wide"
                                            >
                                                PERHATIAN:
                                            </p>
                                            <p class="text-white text-xs">
                                                Tiket ini wajib ditunjukkan
                                                kepada petugas.
                                            </p>
                                            <p class="text-white text-xs">
                                                Tiket ini berlaku untuk satu
                                                orang satu kali pendakian.
                                            </p>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <p
                                                class="text-white font-bold space-y-2 tracking-wide"
                                            >
                                                KONTAK DARURAT:
                                            </p>
                                            <p class="text-white text-xs">
                                                085858038176
                                            </p>
                                            <p class="text-white text-xs">
                                                085784511465
                                            </p>
                                            <p class="text-white text-xs">
                                                081387581187
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-white font-bold tracking-wide"
                                            >
                                                ASURANSI:
                                            </p>
                                            <p class="text-white text-sm">
                                                1. P 3 K
                                            </p>
                                            <p class="text-white text-sm">
                                                2. Evakuasi
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
