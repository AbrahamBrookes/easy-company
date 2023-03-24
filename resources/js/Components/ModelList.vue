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
    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
        <ModelListItem v-for="item in items" :key="item.id" :item="item" />
    </ul>
</template>
