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
    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-10">
        <div v-for="post in posts.data" :key="post.id">
            <div
                class="card hover:translate-y-1 hover:scale-105 transition delay-75 duration-300 ease-in-out"
                @click="openModal(post)"
            >
                <div class="w-full bg-cover bg-center">
                    <img
                        v-if="post.image"
                        :src="`/storage/${post.image}`"
                        alt="Image-Post"
                        class="rounded-lg"
                    />
                    <img
                        v-else
                        class="rounded-lg"
                        src="https://source.unsplash.com/800x500/?mountain"
                        alt="news"
                    />
                </div>

                <div class="p-2 space-y-1">
                    <h1 class="text-lg sm:text-lg font-bold truncate">
                        {{ post.title }}
                    </h1>

                    <div class="flex gap-1">
                        <p class="text-xs flex gap-1">
                            <Icon
                                icon="material-symbols:date-range-rounded"
                                height="14"
                            />
                            {{ post.date_post }}
                        </p>
                        <p class="text-xs flex gap-1">
                            <Icon icon="bi:person" height="14" width="14" />
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
