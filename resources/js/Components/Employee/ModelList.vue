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
            :href="'/employees/' + item.id"
        >
            <template #image>
                <span></span>
            </template>
            <template #default>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    {{ item.first_name }} {{ item.last_name }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    {{ item.phone }}
                </p>
            </template>
            <template #actions>
                {{ item.email }}
            </template>
        </ModelListItem>
    </ul>
</template>
