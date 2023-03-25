<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link class="
        underline text-indigo-800 dark:text-indigo-400
        inline
        hover:text-indigo-600
        cursor-pointer
    ">
        <slot />
    </Link>
</template>
