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
    username: props.auth.user.name,
    email: props.auth.user.email,
    blacklist_id: props.auth.user.blacklist_id,
    check_in: "",
    check_out: "",
    full_name: "",
    address: "",
    phone: "",
    gender: "",
});

const submit = () => {
    form.post("/booking");
};
</script>

<template>
    <Head title="Mount Agung | Booking" />
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
                            <form class="mx-8 my-5" @submit.prevent="submit">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label
                                            for="full_name"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Full Name
                                        </label>
                                        <input
                                            v-model="form.full_name"
                                            type="text"
                                            id="full_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Write your full name..."
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.full_name"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="address"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Address
                                        </label>
                                        <input
                                            v-model="form.address"
                                            type="text"
                                            id="address"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Write your address..."
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.address"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="phone"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                        >
                                            Phone Number
                                        </label>
                                        <input
                                            v-model="form.phone"
                                            type="text"
                                            id="phone"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Write your phone number..."
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.phone"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="gender"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Select a Gender</label
                                        >
                                        <select
                                            v-model="form.gender"
                                            id="gender"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option value="" selected>
                                                Choose a Gender
                                            </option>

                                            <option value="Male">Male</option>
                                            <option value="Female">
                                                Female
                                            </option>
                                        </select>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.gender"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="start_date"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Start Date</label
                                        >
                                        <input
                                            v-model="form.check_in"
                                            type="date"
                                            id="start_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.check_in"
                                        />
                                    </div>

                                    <div>
                                        <label
                                            for="end_date"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >End Date
                                        </label>
                                        <input
                                            v-model="form.check_out"
                                            type="date"
                                            id="end_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.check_out"
                                        />
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="mr-4 flex items-center gap-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2"
                                >
                                    Checkout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <Footer class="bottom-0 lg:absolute w-full" />
        </div>
    </div>
</template>
