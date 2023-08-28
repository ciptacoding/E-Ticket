<script setup>
import { Head, router, usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Html5QrcodeScanner } from "html5-qrcode";
import Swal from "sweetalert2";

function scan() {
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 } },
        /* verbose= */ false
    );
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        router.post(
            "/scan",
            {
                bookingNumber: decodedText,
            },
            {
                onSuccess: () => {
                    html5QrcodeScanner.clear();
                    return Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your data has been save",
                        showConfirmButton: false,
                        timer: 5000,
                    });
                },
            }
        );
    }

    html5QrcodeScanner.render(onScanSuccess);
}

onMounted(() => {
    scan();
});
</script>

<template>
    <div>
        <Head title="Mount Agung | Scan" />
        <DashboardLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Entrance
                </h2>
            </template>

            <div class="py-8">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="">
                        <div class="w-full sm:w-2/4 mx-auto">
                            <div id="reader" width="600px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    </div>
</template>
