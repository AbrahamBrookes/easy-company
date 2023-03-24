<script setup>
import ModelList from '@/Components/ModelList'

const props = defineProps({
    companies: {
        type: Array,
        required: true,
    },
})

</script>

<template>
    <ModelList :items="companies" />
</template>
