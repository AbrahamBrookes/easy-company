<script setup>
import { Head } from '@inertiajs/vue3'
import Link from "@/Components/Link"
import Card from "@/Components/Card"

const props = defineProps({
    numCompanies: {
        type: Number,
        required: true,
    },
    numEmployees: {
        type: Number,
        required: true,
    },
});
</script>

<template>
    <div id="Dashboard">
        <Head title="Dashboard" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!--
                    Some intro text, full width card
                -->
                <div class="mb-8">
                    <Card>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Welcome to the Easy Company App
                        </h1>
                        <p class="mt-2 text-gray-700 dark:text-gray-400">
                            This is a simple CRUD app built with Laravel and Inertia.js
                        </p>
                    </Card>
                </div>

                <!--
                    a 4 col responsive layout with two widgets:
                    - num companies
                    - num employees
                    Each with links to their relevant list pages
                -->
                <div class="
                    grid md:grid-cols-4 sm:grid-cols-2 gap-8
                ">
                    <Link
                        href="/companies"
                        class="
                            hover:shadow-xl transition-shadow
                            no-underline
                        "
                    >
                        <Card>
                            <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{  numCompanies }}</h1>
                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                Currently registered companies
                            </p>
                            <hr class="my-4" />
                            <div class="text-right">
                                <Link href="/companies">View all</Link>
                            </div>
                        </Card>
                    </Link>

                    <Link
                        href="/employees"
                        class="
                            hover:shadow-xl transition-shadow
                            no-underline
                        "
                    >
                        <Card>
                            <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{  numEmployees }}</h1>
                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                Currently registered employees
                            </p>
                            <hr class="my-4" />
                            <div class="text-right">
                                <Link href="/employees">View all</Link>
                            </div>
                        </Card>
                    </Link>


                </div>
            </div>
        </div>
    </div>
</template>
