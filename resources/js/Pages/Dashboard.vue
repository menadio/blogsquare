<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Sort from "@/Components/Sort.vue";

const props = defineProps(["posts", "sort_fields", "sort_directions"]);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="py-12">
                <!-- flash success message -->
                <div
                    v-if="$page.props.flash.success"
                    class="max-x-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-green-100 text-center"
                >
                    {{ $page.props.flash.success }}
                </div>

                <!-- list of published post -->
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
                    <Sort
                        :sort_fields="sort_fields"
                        :sort_directions="sort_directions"
                        :url="route('dashboard')"
                    ></Sort>

                    <div
                        v-for="post in posts.data"
                        :key="post.id"
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <article class="p-6 bg-white border-b border-gray-200">
                            <div>
                                <h3 class="text-3xl capitalize">
                                    {{ post.title }}
                                </h3>
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
                        </article>
                    </div>
                </div>
            </div>

            <!-- pagination nav -->
            <nav
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 pb-3 flex items-center justify-between rounded-lg"
                aria-label="Pagination"
            >
                <div class="hidden sm:block">
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ posts.from }}</span>
                        {{ " " }}
                        to
                        <span class="font-medium">{{ posts.to }}</span>
                        {{ " " }}
                        of
                        <span class="font-medium">{{ posts.total }}</span>
                        {{ " " }}
                        results
                    </p>
                </div>
                <div class="flex-1 flex justify-between sm:justify-end">
                    <a
                        :href="posts.prev_page_url"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Previous
                    </a>
                    <a
                        :href="posts.next_page_url"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Next
                    </a>
                </div>
            </nav>
        </div>
    </AuthenticatedLayout>
</template>
