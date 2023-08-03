<script setup>
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
</script>

<template>
    <div>
        <nav
            class="lg:hidden mt-5 py-4 px-3 sm:px-10 fixed bottom-0 left-0 right-0 w-full bg-white z-50 shadow"
        >
            <div class="flex text-sm sm:text-xl gap-2 justify-between">
                <Link :href="route('home')" class="flex flex-col items-center">
                    <Icon icon="ri:home-3-line" class="text-2xl" />
                    <p>Home</p>
                </Link>
                <Link
                    :href="route('booking.index')"
                    class="flex flex-col items-center"
                >
                    <Icon icon="ri:ticket-2-line" class="text-2xl" />
                    <p>Booking</p>
                </Link>
                <Link :href="route('home')" class="flex flex-col items-center">
                    <Icon icon="ri:calendar-check-line" class="text-2xl" />
                    <p>Quota</p>
                </Link>
                <Link
                    :href="route('suggestion.index')"
                    class="flex flex-col items-center"
                >
                    <Icon icon="ri:mail-add-line" class="text-2xl" />
                    <p>Suggest</p>
                </Link>
            </div>
        </nav>
    </div>
</template>
