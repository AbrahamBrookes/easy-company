<script setup>
import ModelListItem from '@/Components/ModelListItem'

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
})
</script>

<template>
    <ul class="w-full divide-y divide-gray-200 dark:divide-gray-700">
        <ModelListItem
            v-for="item in items"
            :key="item.id"
            :item="item"
            :href="'/companies/' + item.id"
        >
            <template #image>
                <img class="w-8 h-8" :src="item.logo" :alt="item.name">
            </template>
            <template #default>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    {{ item.name }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    {{ item.email }}
                </p>
            </template>
            <template #actions>
                <a :href="item.website" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                    {{ item.website }}
                </a>
            </template>
        </ModelListItem>
    </ul>
</template>
