<script setup>
import { reactive } from 'vue';
import useAuth from '@/composable/useAuth';
import router from '@/router';
import { RouterLink } from 'vue-router';

const { login: loginAction, errors } = useAuth();


const form = reactive({
    email: 'admin@admin.com',
    password: 'password'
});

const login = async () => {
    loginAction(form).then(() => {
        // Redirect to dashboard or home page after successful login
        router.push({ name: 'dashboard' });
    })
}
</script>

<template>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Sign in
            </h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form @submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input v-model="form.email" id="email" name="email" type="email"
                            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <p v-if="errors.email" class="mt-2 text-sm text-red-600" id="email-error">{{ errors.email[0] }}</p>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2"><input v-model="form.password" id="password" name="password" type="password"
                            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <p v-if="errors.password" class="mt-2 text-sm text-red-600" id="password-error">{{
                        errors.password[0]
                    }}</p>

                </div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">Sign
                        In</button>
                </div>

            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                <RouterLink :to="{ name: 'register' }"
                    class="font-semibold leading-6 text-indigo-600 hover: text-indigo-500">Register</RouterLink>
            </p>

        </div>
    </div>
</template>