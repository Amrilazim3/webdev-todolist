<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    task: ""
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-white p-6 rounded-lg shadow-xl">
                        <h2
                            class="text-xl font-medium text-center text-gray-800 mb-6"
                        >
                            Add a new To-Do
                        </h2>
                        <form>
                            <div class="flex">
                                <input
                                    class="bg-gray-50 px-4 rounded-tl-lg rounded-bl-lg w-full"
                                    type="text"
                                    placeholder="Enter your task"
                                />
                                <button class="text-md font-semibold px-4 py-2 rounded-tr-lg rounded-br-lg bg-indigo-500 hover:bg-opacity-80 text-white">
                                    Add
                                </button>
                            </div>
                        </form>
                        <div class="mt-6">
                            <h2
                                class="text-xl font-medium text-center text-gray-800 mb-6"
                            >
                                To-Do List
                            </h2>
                            <ul class="text-gray-800">
                                <li class="py-2">
                                    <input class="mr-2 text-indigo-500 border-indigo-500 rounded-sm" type="checkbox" />
                                    Task 1
                                </li>
                                <li class="py-2">
                                    <input class="mr-2 text-indigo-500 border-indigo-500 rounded-sm" type="checkbox" />
                                    Task 2
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
