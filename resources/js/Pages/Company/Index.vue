<script setup>
import { router } from '@inertiajs/vue3'
import ModelList from '@/Components/Company/ModelList'
import Content from '@/Components/Content'
import Card from '@/Components/Elements/Card'
import H2 from '@/Components/Elements/H2'
import PrimaryButton from '@/Components/Elements/PrimaryButton'

const props = defineProps({
    companies: {
        type: Array,
        required: true,
    },
})

function create(){
    router.visit(route('companies/create'))
}

</script>

<template>
    <Content>
        <div class="flex w-full justify-between items-center mb-4">
            <H2>
                Companies
            </H2>
            <PrimaryButton
                @click="create"
            >
                Create new Company
            </PrimaryButton>
        </div>

        <Card>
            <ModelList
                :items="companies.data"
            />
        </Card>
    </Content>
</template>
