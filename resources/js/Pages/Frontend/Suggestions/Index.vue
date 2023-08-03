<script setup>
import NavbarOther from "@/Components/NavbarOther.vue";
import MobileNavbar from "@/Components/MobileNavbar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    auth: {
        type: Object,
    },
});

const form = useForm({
    user_id: props.auth.user.id,
    comment: "",
    suggestion: "",
});

const submit = () => {
    form.post("/suggestion");
    form.reset();
};
</script>

<template>
    <Head title="Mount Agung | Suggestion" />
    <div>
        <div class="bg-gray-100 min-h-screen relative">
            <!-- navbar mobile view -->
            <MobileNavbar />
            <!-- navbar mobile view -->
            <NavbarOther :can-login="canLogin" :can-register="canRegister" />

            <div class="pt-32 lg:pt-44">
                <div class="w-full mx-auto px-4 sm:px-12 lg:px-28">
                    <div class="shadow-md rounded-md">
                        <div
                            class="relative overflow-x-auto rounded-md py-6 bg-white"
                        >
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <form
                                    class="mx-8 my-5"
                                    @submit.prevent="submit"
                                >
                                    <div class="grid gap-6 mb-6 grid-cols-1">
                                        <div>
                                            <h1
                                                class="text-center text-xl font-bold mb-2 lg:mb-4"
                                            >
                                                Suggestion And Location
                                            </h1>
                                            <h1 class="text-sm text-gray-500">
                                                Note: Please send your comments
                                                and suggestions to help us
                                                improve the quality of the
                                                website
                                            </h1>
                                        </div>
                                        <div>
                                            <label
                                                for="comment"
                                                class="block mb-2 text-sm font-medium text-gray-900"
                                            >
                                                Comment
                                            </label>
                                            <input
                                                v-model="form.comment"
                                                type="text"
                                                id="comment"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Write your comment..."
                                                required
                                            />
                                            <InputError
                                                class="mt-2"
                                                :message="form.errors.comment"
                                            />
                                        </div>

                                        <div>
                                            <label
                                                for="suggestion"
                                                class="block mb-2 text-sm font-medium text-gray-900"
                                            >
                                                Suggestion
                                            </label>
                                            <input
                                                v-model="form.suggestion"
                                                type="text"
                                                id="suggestion"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Write your suggestion..."
                                                required
                                            />
                                            <InputError
                                                class="mt-2"
                                                :message="
                                                    form.errors.suggestion
                                                "
                                            />
                                        </div>
                                    </div>

                                    <button
                                        type="submit"
                                        class="mr-4 flex items-center gap-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-8 py-2.5 text-center mb-2"
                                    >
                                        Send
                                    </button>
                                </form>
                                <div class="mx-8 my-5">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13181.919067965719!2d115.45603071886158!3d-8.361591233655462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd21d17409f1719%3A0x94839c8adc5204ba!2sGUIDE%20GUNUNG%20AGUNG!5e0!3m2!1sid!2sid!4v1691036233481!5m2!1sid!2sid"
                                        class="w-full"
                                        height="400"
                                        style="border: 0"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Footer class="bottom-0 w-full" />
        </div>
    </div>
</template>
