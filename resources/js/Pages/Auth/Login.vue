<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div
        class="min-h-screen grid grid-cols-1 lg:grid-cols-12 bg-[#FAF7F2] font-sans selection:bg-amber-200 selection:text-amber-900">
        <!-- Left Side: Cinematic Coffee Shop Image (Visible on Desktop) -->
        <div class="hidden lg:flex lg:col-span-7 relative overflow-hidden bg-amber-950">
            <!-- Background Image -->
            <img src="/images/coffee_shop_login.png"
                class="absolute inset-0 h-full w-full object-cover opacity-80 scale-100 hover:scale-105 transition-transform duration-10000 ease-out"
                alt="Cozy Coffee Shop" />
            <!-- Dark Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-tr from-amber-950/90 via-amber-950/40 to-transparent"></div>

            <!-- Branding Overlay Content -->
            <div class="absolute inset-0 z-10 flex items-center justify-center p-16 text-white">
                <!-- Logo/Brand Center -->
                <div
                    class="flex flex-col items-center gap-4 text-center bg-amber-950/20 backdrop-blur-md px-10 py-12 rounded-3xl border border-white/10 shadow-2xl">
                    <div class="bg-white/10 p-4 rounded-2xl border border-white/20 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-12 h-12 text-amber-100">
                            <path
                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-3xl tracking-widest text-amber-50 drop-shadow">POS Coffee
                        Shop</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Beautiful Warm Coffee-Themed Login Form -->
        <div class="col-span-12 lg:col-span-5 flex items-center justify-center p-6 sm:p-12 lg:p-16">
            <div class="w-full max-w-md">
                <!-- Small Logo for Mobile/Tablet -->
                <div class="lg:hidden flex items-center gap-3 mb-8 justify-center">
                    <div class="bg-amber-800 p-2.5 rounded-xl text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path
                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-wider text-amber-900">POS Coffee Shop</span>
                </div>

                <!-- Form Header -->
                <div class="mb-10 text-center">
                    <h2 class="text-3xl font-extrabold text-amber-950 tracking-tight">Selamat Datang</h2>
                </div>

                <!-- Session Status -->
                <div v-if="status"
                    class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-sm font-medium text-green-700">
                    {{ status }}
                </div>

                <!-- Form Container -->
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <InputLabel for="email" value="Alamat Email" class="text-amber-900 font-semibold mb-1.5" />

                        <div class="relative">
                            <TextInput id="email" type="email"
                                class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-600 focus:ring focus:ring-amber-200 focus:ring-opacity-50 bg-white shadow-sm transition-all duration-200 placeholder:text-gray-400 py-3"
                                v-model="form.email" required autofocus autocomplete="username"
                                placeholder="nama@beansbrew.com" />
                        </div>

                        <InputError class="mt-2 text-sm" :message="form.errors.email" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <InputLabel for="password" value="Kata Sandi" class="text-amber-900 font-semibold mb-1.5" />
                            <Link v-if="canResetPassword" :href="route('password.request')"
                                class="text-xs font-semibold text-amber-700 hover:text-amber-900 transition-colors">
                                Lupa sandi?
                            </Link>
                        </div>

                        <TextInput id="password" type="password"
                            class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-600 focus:ring focus:ring-amber-200 focus:ring-opacity-50 bg-white shadow-sm transition-all duration-200 placeholder:text-gray-400 py-3"
                            v-model="form.password" required autocomplete="current-password"
                            placeholder="Masukkan kata sandi" />

                        <InputError class="mt-2 text-sm" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <Checkbox name="remember" v-model:checked="form.remember"
                                class="rounded border-amber-300 text-amber-700 focus:ring-amber-500" />
                            <span
                                class="ms-2.5 text-sm text-amber-800 font-medium group-hover:text-amber-950 transition-colors">
                                Ingat saya di perangkat ini
                            </span>
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-amber-800 hover:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 active:scale-[0.98] disabled:opacity-50 disabled:pointer-events-none transition-all duration-200 shadow-amber-800/10 hover:shadow-amber-800/20 cursor-pointer"
                            :disabled="form.processing">
                            <span v-if="form.processing" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                            <span v-else>Masuk</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
