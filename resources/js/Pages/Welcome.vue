<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Sort from "@/Components/Sort.vue";

const props = defineProps(["posts", "sort_fields", "sort_directions"]);
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center bg-gray-100 sm:items-center sm:pt-0"
    >
        <div
            class="hidden fixed items-center justify-between top-0 right-0 px-6 py-4 sm:block w-full"
        >
            <Link
                v-if="$page.props.auth.user"
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
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>
    </div>

    <div class="mt-24">
        <div v-if="posts.data.length == 0" class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    Welcome to
                    <span class="text-cyan-700 font-black tracking-wide"
                        >BlogSquare</span
                    >! Register now and be the first to post an article.
                </div>
            </div>
        </div>

        <div v-else class="mt-8 mx-auto sm:px-6 lg:px-48">
            <Sort
                :sort_fields="sort_fields"
                :sort_directions="sort_directions"
                :url="route('home')"
            ></Sort>

            <article
                v-for="post in posts.data"
                :key="post.id"
                class="flex flex-col shadow my-4"
            >
                <div class="bg-white flex flex-col justify-start p-6">
                    <Link
                        :href="route('posts.show', post.slug)"
                        class="text-3xl hover:text-gray-700 pb-4 capitalize"
                        >{{ post.title }}</Link
                    >
                    <p class="text-sm pb-3">
                        By
                        <span class="font-semibold hover:text-gray-800">{{
                            post.user.name
                        }}</span
                        >,
                        <span class="text-gray-500"
                            >Published on {{ post.publication_date }}</span
                        >
                    </p>
                    <p class="pb-6">{{ post.description }}</p>
                    <Link
                        :href="route('posts.show', post.slug)"
                        class="uppercase text-gray-800 hover:text-black text-sm"
                        >Continue Reading <i class="fas fa-arrow-right"></i
                    ></Link>
                </div>
            </article>

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
    </div>
</template>
