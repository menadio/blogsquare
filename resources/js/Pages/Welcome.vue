<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["posts"]);
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0"
    >
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
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

        <div class="mx-auto sm:px-6 lg:px-48">
            <article
                v-for="post in posts.data"
                :key="post.id"
                class="flex flex-col shadow my-4"
            >
                <!-- Article Image -->
                <div class="bg-white flex flex-col justify-start p-6">
                    <Link
                        :href="route('posts.show', post.slug)"
                        class="text-3xl font-bold hover:text-gray-700 pb-4 capitalize"
                        >{{ post.title }}</Link
                    >
                    <p href="#" class="text-sm pb-3">
                        By
                        <a href="#" class="font-semibold hover:text-gray-800">{{
                            post.user.name
                        }}</a
                        >, Published on {{ post.publication_date }}
                    </p>
                    <a href="#" class="pb-6">{{ post.description }}</a>
                    <Link
                        :href="route('posts.show', post.slug)"
                        class="uppercase text-gray-800 hover:text-black text-sm"
                        >Continue Reading <i class="fas fa-arrow-right"></i
                    ></Link>
                </div>
            </article>

            <!-- Pagination -->
            <div class="flex items-center py-8">
                <a
                    href="#"
                    class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center"
                    >1</a
                >
                <a
                    href="#"
                    class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center"
                    >2</a
                >
                <Link
                    :href="posts.next_page_url"
                    class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3"
                    >Next <i class="fas fa-arrow-right ml-2"></i
                ></Link>
            </div>
        </div>
    </div>
</template>
