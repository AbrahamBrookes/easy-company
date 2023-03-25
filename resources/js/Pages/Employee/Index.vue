<script setup>
import ModelList from '@/Components/Employee/ModelList'
import Content from '@/Components/Content'

const props = defineProps({
    employees: {
        type: Array,
        required: true,
    },
})

</script>

<template>
    <Content>
        <ModelList
            :items="employees.data"
        />
    </Content>
</template>
