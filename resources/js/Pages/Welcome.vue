<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center bg-gray-100 sm:items-center sm:pt-0"
    >
        <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
        >
            <Link
                v-if="$page.props.user"
                :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-700 dark:text-gray-500 underline"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>

        <div class="container mx-auto flex items-center justify-center">
            <div class="w-full max-w-md py-20">
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h1
                        class="text-3xl font-medium text-center text-gray-800 mb-6"
                    >
                        Welcome to To-Do List
                    </h1>
                    <p class="mb-4 text-center text-gray-800">
                        This is a simple and easy to use application that helps
                        you keep track of your tasks and to-dos. Start adding
                        tasks and stay organized.
                    </p>
                    <div class="text-center">
                        <Link
                            :href="route('login')"
                            class="bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600"
                        >
                            Start using
                        </Link>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-xl mt-6">
                    <h2
                        class="text-xl font-medium text-center text-gray-800 mb-6"
                    >
                        Features
                    </h2>
                    <ul class="text-gray-800">
                        <li class="py-2">Easy to use interface</li>
                        <li class="py-2">Task categorization</li>
                        <li class="py-2">Task prioritization</li>
                        <li class="py-2">Task reminders</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-xl mt-6">
                    <h2
                        class="text-xl font-medium text-center text-gray-800 mb-6"
                    >
                        Testimonials
                    </h2>
                    <div class="flex items-center justify-center space-x-4">
                        <div class="w-1/3 bg-gray-100 rounded-md p-4">
                            <blockquote class="text-center text-gray-800">
                                This app is a lifesaver. It helped me stay
                                organized and on top of my tasks.
                                <cite
                                    class="block mt-2 text-right text-gray-800"
                                    >- John Doe</cite
                                >
                            </blockquote>
                        </div>
                        <div class="w-1/3 bg-gray-100 rounded-md p-4">
                            <blockquote class="text-center text-gray-800">
                                I love this app. It's simple, easy to use and it
                                helps me stay productive.
                                <cite
                                    class="block mt-2 text-right text-gray-800"
                                    >- Jane Smith</cite
                                >
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <Link
                        :href="route('login')"
                        class="bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600"
                    >
                        Start using
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
