<script setup>
defineProps({
    isModalOpen: {
        type: Boolean,
    },
    selectedPost: {
        type: Object,
    },
    closeModal: {
        type: Function,
    },
});
</script>

<template>
    <div>
        <!-- Main modal -->
        <div
            :class="isModalOpen ? '' : 'hidden'"
            class="flex justify-center items-center backdrop-opacity-10 backdrop-invert bg-black/50 fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full"
        >
            <div class="relative w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div
                        class="flex items-start justify-between p-2 border-b rounded-t"
                    >
                        <button
                            @click="closeModal"
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ml-auto inline-flex justify-center items-center"
                        >
                            <svg
                                class="w-3 h-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 space-y-3">
                        <h3
                            class="text-xl text-center font-semibold text-gray-900"
                        >
                            {{ selectedPost.title }}
                        </h3>
                        <img
                            v-if="selectedPost.image"
                            :src="`/storage/${selectedPost.image}`"
                            alt="Image-Post"
                            class="rounded-lg h-64 sm:h-80 w-full object-cover"
                        />
                        <img
                            v-else
                            class="rounded-lg h-64 sm:h-80 w-full object-cover"
                            src="https://source.unsplash.com/800x500/?mountain"
                            alt="news"
                        />
                        <!-- <p>By {{ selectedPost.user.name }}</p> -->
                        <p
                            class="text-base text-gray-700 underline underline-offset-4 text-center"
                        >
                            Posted Date: {{ selectedPost.date_post }}
                        </p>
                        <p class="text-base leading-relaxed text-gray-500">
                            {{ selectedPost.body }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
