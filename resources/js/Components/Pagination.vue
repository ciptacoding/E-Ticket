<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: {
        type: Array,
    },
    next_page_url: {
        type: String,
    },
    prev_page_url: {
        type: String,
    },
});
</script>

<template>
    <div v-if="links.length > 2">
        <!-- web view -->
        <div class="hidden sm:flex flex-wrap mb-1 mt-2 mr-4 justify-end">
            <template v-for="(link, k) in links" :key="k">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-3 text-gray-400 border rounded"
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-3 border rounded focus:border-indigo-500 focus:text-indigo-500"
                    :class="
                        link.active === true
                            ? 'bg-indigo-400 hover:bg-indigo-500 text-white'
                            : 'bg-white'
                    "
                    :href="link.url"
                    v-html="link.label"
                    preserve-scroll
                />
            </template>
        </div>
        <!-- web view -->

        <!-- mobile view -->
        <div class="sm:hidden flex gap-2 justify-end">
            <Link
                :href="prev_page_url ?? ''"
                preserve-scroll
                class="mr-1 mb-1 px-4 py-3 text-sm bg-white leading-3 text-gray-900 border rounded"
                >Previous</Link
            >
            <Link
                :href="next_page_url ?? ''"
                preserve-scroll
                class="mr-1 mb-1 px-4 py-3 text-sm bg-white leading-3 text-gray-900 border rounded"
                >Next</Link
            >
        </div>
        <!-- mobile view -->
    </div>
</template>
