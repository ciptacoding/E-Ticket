<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: {
        type: Array,
    },
});
</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mb-1 mt-2 justify-end">
            <template v-for="(link, k) in links" :key="k">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-3 text-gray-400 border rounded"
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-3 border rounded focus:border-indigo-500 focus:text-indigo-500"
                    :class="{
                        'bg-indigo-400 hover:bg-indigo-500 text-white':
                            link.active,
                    }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>
