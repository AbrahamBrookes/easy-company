<script setup>

const props = defineProps({
    // matches laravel pagination meta
    meta: {
        type: String,
    },
});
</script>

<template>
    <nav>
        <ul class="inline-flex items-center -space-x-px">
            <li v-for="link in meta.links" :key="link.label">
                <a :href="link.url" :class="{
                    'px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': ! link.active,
                    'z-10 px-3 py-2 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': link.active,
                }">{{  link.label }}</a>
            </li>
        </ul>
    </nav>
</template>
