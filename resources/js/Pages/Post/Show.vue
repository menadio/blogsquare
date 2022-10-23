<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["post"]);
</script>

<template>
    <Head title="Post" />

    <div>
        <!-- Post Section -->
        <section class="mx-auto sm:px-6 lg:px-48">
            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <div class="bg-white flex flex-col justify-start p-6">
                    <h2
                        class="text-3xl font-bold hover:text-gray-700 pb-4 capitalize"
                    >
                        {{ post.title }}
                    </h2>

                    <p class="text-sm pb-8">
                        By
                        <span
                            href="#"
                            class="font-semibold hover:text-gray-800"
                            >{{ post.user.name }}</span
                        >, Published on {{ post.publication_date }}
                    </p>

                    <div>
                        {{ post.description }}
                    </div>
                </div>
            </article>
        </section>
    </div>
</template>
