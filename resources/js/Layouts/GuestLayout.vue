<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('/img/bg-gunung.png')] bg-center bg-cover"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="w-38 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="w-11/12 mx-4 sm:max-w-md mt-6 px-6 py-4 bg-white bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-50 shadow-md overflow-hidden rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
