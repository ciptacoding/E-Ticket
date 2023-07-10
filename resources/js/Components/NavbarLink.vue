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
        ? "inline-flex items-center border-b-2 border-white text-white font-semibold"
        : "inline-flex items-center border-b-2 border-transparent text-white font-semibold"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
