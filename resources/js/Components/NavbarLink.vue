<script setup>
import { computed, ref, onMounted } from "vue";
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

const scroll = ref(false);

const classes = computed(() =>
    props.active
        ? "inline-flex items-center border-b-2 border-white text-white font-semibold"
        : "inline-flex items-center border-b-2 border-transparent text-white font-semibold"
);

const onScroll = computed(() =>
    props.active
        ? "inline-flex items-center border-b-2 border-black text-gray-800 font-semibold"
        : "inline-flex items-center border-b-2 border-transparent text-gray-800 font-semibold"
);

const handleScroll = () => {
    if (window.scrollY > 40) {
        scroll.value = true;
    } else {
        scroll.value = false;
    }
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});
</script>

<template>
    <Link :href="href" :class="scroll ? onScroll : classes">
        <slot />
    </Link>
</template>
