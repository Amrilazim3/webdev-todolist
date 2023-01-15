<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    todos: Array,
});

const form = useForm({
    task: "",
});

const save = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("dashboard.post"), {
        preserveScroll: false,
        onSuccess: () => {
            form.reset();
        },
    });
};

const deleteTask = (id) => {
    Inertia.delete(`/dashboard/${id}`, {
        preserveScroll: false,
    });
};

const setTaskComplete = (todo) => {
    Inertia.patch(
        `/dashboard/${todo.id}`,
        { 
            isCompleted: todo.is_completed,
        },
        {
            preserveScroll: false,
        }
    );
};
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
                        <form @submit.prevent="save">
                            <div class="flex">
                                <input
                                    class="bg-gray-50 px-4 rounded-tl-lg rounded-bl-lg w-full"
                                    type="text"
                                    placeholder="Enter your task"
                                    v-model="form.task"
                                />
                                <button
                                    @click="save"
                                    class="text-md font-semibold px-4 py-2 rounded-tr-lg rounded-br-lg bg-indigo-500 hover:bg-opacity-80 text-white"
                                >
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
                                <template v-if="todos.length > 0">
                                    <template
                                        v-for="todo in todos"
                                        :key="todo.id"
                                    >
                                        <li class="py-2 flex justify-between">
                                            <div class="flex space-x-3">
                                                <input
                                                    class="mr-2 self-center text-indigo-500 border-indigo-500 rounded-sm"
                                                    type="checkbox"
                                                    :checked="todo.is_completed"
                                                    @change="
                                                        setTaskComplete(
                                                            todo
                                                        )
                                                    "
                                                />
                                                {{ todo.task }}
                                            </div>
                                            <button
                                                @click="deleteTask(todo.id)"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-red-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    />
                                                </svg>
                                            </button>
                                        </li>
                                    </template>
                                </template>
                                <template v-else>
                                    <h3 class="text-indigo-500 text-lg">
                                        No todo yet...
                                    </h3>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
