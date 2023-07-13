<script setup>
defineProps({
    posts: {
        type: Object,
    },
});
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-10">
        <div v-for="post in posts.data" :key="post.id">
            <div
                class="card hover:translate-y-1 hover:scale-105 transition delay-75 duration-300 ease-in-out"
            >
                <img
                    v-if="post.image"
                    :src="`/storage/${post.image}`"
                    alt="Image-Post"
                    class="rounded-t-lg"
                />

                <img
                    v-else
                    class="rounded-t-lg"
                    src="https://source.unsplash.com/800x500/?mountain"
                    alt="news"
                />

                <div class="p-6">
                    <p class="text-sm mb-4">
                        {{ post.date_post }}
                    </p>
                    <h1 class="text-lg font-bold mb-2">
                        {{ post.title }}
                    </h1>
                    <p class="text-gray-600 truncate">
                        {{ post.excerpt }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
