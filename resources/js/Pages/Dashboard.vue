<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["posts"]);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <!-- flash message -->
        <div class="px-4 sm:px-6 lg:px-8">
            <!-- list of published post -->
            <div class="py-12">
                <!-- success message -->
                <div
                    v-if="$page.props.flash.success"
                    class="max-x-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-green-100 text-center"
                >
                    {{ $page.props.flash.success }}
                </div>

                <div
                    v-if="posts.length == 0"
                    class="max-w-7xl mx-auto sm:px-6 lg:px-8"
                >
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div
                            class="p-6 bg-white border-b border-gray-200 text-center"
                        >
                            Welcome to
                            <span class="text-cyan-700 font-black tracking-wide"
                                >BlogSquare</span
                            >! Get started by creating your first post
                            <Link
                                :href="route('posts.create')"
                                class="underline"
                                >here</Link
                            >
                        </div>
                    </div>
                </div>

                <div v-else class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        v-for="post in posts"
                        :key="post.id"
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div
                            class="p-6 bg-white border-b border-gray-200 capitalize"
                        >
                            <div>
                                <h3 class="text-3xl">{{ post.title }}</h3>
                                <p class="mt-2 text-gray-500">
                                    {{ post.publication_date }}
                                </p>
                            </div>

                            <div class="mt-4">
                                <Link
                                    :href="route('posts.show', post.slug)"
                                    class="text-indigo-700 text-xs"
                                    >VIEW</Link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
