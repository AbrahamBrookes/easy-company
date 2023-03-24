<script setup>
/**
 * This component is meant as a base for model lists around the app.
 * You'll likely never use this component directly, rather use is as
 * a base for your own model list components.
 */
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
        <ModelListItem v-for="item in items" :key="item.id" :item="item" />
    </ul>
</template>
