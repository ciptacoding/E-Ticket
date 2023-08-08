<script setup>
import Modal from "./Modal.vue";
import { ref } from "vue";
import { Icon } from "@iconify/vue";

defineProps({
    posts: {
        type: Object,
    },
});

const selectedPost = ref({});
const isModalOpen = ref(false);

const openModal = (post) => {
    selectedPost.value = post;
    isModalOpen.value = true;
};

const closeModal = () => {
    selectedPost.value = {};
    isModalOpen.value = false;
};
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-10">
        <div v-for="post in posts.data" :key="post.id">
            <div
                class="card hover:translate-y-1 hover:scale-105 transition delay-75 duration-300 ease-in-out"
                @click="openModal(post)"
            >
                <div
                    class="w-full h-[200px] sm:h-[230px] md:h-[250px] min-[1700px]:h-[300] overflow-y-hidden"
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
                </div>

                <div class="p-6 space-y-2">
                    <h1 class="text-lg sm:text-xl font-bold">
                        {{ post.title }}
                    </h1>

                    <div class="flex gap-10">
                        <p class="text-sm font-semibold flex gap-1">
                            <Icon
                                icon="material-symbols:date-range-rounded"
                                height="18"
                            />
                            {{ post.date_post }}
                        </p>
                        <p class="text-sm font-semibold flex gap-1">
                            <Icon icon="bi:person" height="18" width="18" />
                            {{ post.user.name }}
                        </p>
                    </div>
                    <p class="text-gray-600 truncate">
                        {{ post.excerpt }}
                    </p>
                </div>
            </div>
        </div>
        <Modal
            :selectedPost="selectedPost"
            :isModalOpen="isModalOpen"
            :closeModal="closeModal"
        />
    </div>
</template>
