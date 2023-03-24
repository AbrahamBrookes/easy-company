<script setup>
import ModelList from '@/Components/Company/ModelList'
import Content from '@/Components/Content'

const props = defineProps({
    companies: {
        type: Array,
        required: true,
    },
})

</script>

<template>
    <Content>
        <ModelList
            :items="companies.data"
        />
    </Content>
</template>
