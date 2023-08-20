<script setup>
import { Head, router, usePage } from "@inertiajs/vue3";
import NavbarOther from "@/Components/NavbarOther.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import Footer from "@/Components/Footer.vue";
import "notyf/notyf.min.css";
import Pagination from "@/Components/Pagination.vue";
import { ref } from "vue";
import { Html5QrcodeScanner } from "html5-qrcode";
import Swal from "sweetalert2";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    listTicket: {
        type: Object,
        default: () => ({}),
    },
});

const selectedTicket = ref({});
const isModalOpen = ref(false);

const openModal = (ticket) => {
    selectedTicket.value = ticket;
    isModalOpen.value = true;

    async function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);
        router.post("/scan", {
            id: ticket.id,
            check_in: ticket.check_in,
            result: decodedText,
        });
        await new Promise((resolve) => setTimeout(resolve, 1000));
        if (usePage().props.flash.message !== null) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: usePage().props.flash.message,
            });
            usePage().props.flash.message = null;
        }
    }

    // function onScanFailure(error) {
    //     // handle scan failure, usually better to ignore and keep scanning.
    //     // for example:
    //     console.warn(`Code scan error = ${error}`);
    // }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 } },
        /* verbose= */ false
    );
    html5QrcodeScanner.render(onScanSuccess);
};

const closeModal = () => {
    selectedTicket.value = {};
    isModalOpen.value = false;
};
</script>

<template>
    <Head title="Mount Agung | Booking" />
    <div>
        <MobileNavbar />
        <!-- navbar mobile view -->
        <NavbarOther :can-login="canLogin" :can-register="canRegister" />

        <div class="py-28 lg:py-32">
            <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="shadow rounded-md">
                    <div
                        class="relative overflow-x-auto rounded-md py-6 bg-white"
                    >
                        <h1
                            class="text-center font-bold text-xl mt-16 sm:mt-8 mb-2"
                        >
                            Scan Your E-Ticket When Check-In And Check-Out
                        </h1>
                        <p class="text-sm text-center px-8 text-gray-600 mb-6">
                            Note: Please make sure your ticket are correct and
                            make sure the payment is success.
                        </p>
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Scan Qrcode
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Full Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check In Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check Out Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="ticket in listTicket.data"
                                    :key="ticket.id"
                                    class="bg-white border-b"
                                >
                                    <td class="px-6 py-4 flex justify-center">
                                        <button
                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg lg:text-sm text-xs px-5 py-2.5 text-center"
                                            @click.prevent="openModal(ticket)"
                                        >
                                            Scan QR Code
                                        </button>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ ticket.order_date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ ticket.full_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ ticket.check_in }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ ticket.check_out }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{
                                            ticket.entrance
                                                ? ticket.entrance
                                                      .status_entrances
                                                : "-"
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :links="listTicket.links" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div
            :class="isModalOpen ? '' : 'hidden'"
            class="flex justify-center items-center backdrop-opacity-10 backdrop-invert bg-black/50 fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full"
        >
            <div class="relative w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div
                        class="flex items-start justify-between p-2 border-b rounded-t"
                    >
                        <button
                            @click="closeModal"
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ml-auto inline-flex justify-center items-center"
                        >
                            <svg
                                class="w-3 h-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div id="reader" width="600px" class="p-4 space-y-3"></div>
                </div>
            </div>
        </div>
    </div>
</template>
