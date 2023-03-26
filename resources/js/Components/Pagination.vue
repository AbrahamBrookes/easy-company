<script setup>

const props = defineProps({
    // matches laravel pagination meta
    meta: {
        type: String,
    },
});

// remove arrows from "previous" and "next" links
const links = props.meta.links.map((link) => {
    if (link.label === '&laquo; Previous') {
        link.label = 'Previous';
    } else if (link.label === 'Next &raquo;') {
        link.label = 'Next';
    }

    return link;
});
</script>

<template>
    <nav>
        <ul class="inline-flex items-center -space-x-px">
            <li v-for="link in links" :key="link.label">
                <a :href="link.url" :class="{
                    'rounded-full text-sm m-[1px] px-3 py-2 leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': ! link.active,
                    'rounded-full text-sm m-[1px] z-10 px-3 py-2 leading-tight text-indigo-600 bg-indigo-50 hover:bg-indigo-100 hover:text-indigo-700 dark:border-indigo-700 dark:bg-indigo-700 dark:text-indigo-100': link.active,
                }">{{  link.label }}</a>
            </li>
        </ul>
    </nav>
</template>
