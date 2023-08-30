<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "inline-flex items-center bg-gray-800 rounded-md px-4 py-2 font-medium leading-5 text-lg text-white transition hover:text-gray-700 duration-150 ease-in-out"
        : "inline-flex px-4 py-2 items-center text-lg font-medium leading-5 text-white hover:text-gray-700 transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
