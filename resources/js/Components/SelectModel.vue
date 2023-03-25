<script setup>
import Dropdown from '@/Components/Elements/Dropdown'
import DropdownOption from '@/Components/Elements/DropdownOption'
import InputLabel from '@/Components/Elements/InputLabel'

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    models: {
        type: Array,
        required: true,
    },
})

const emits = defineEmits(['selected'])

</script>

<template>
    <div class="flex flex-col">
        <InputLabel :value="label" />

        <div class="sm:flex sm:items-center sm:ml-6">
            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
                <Dropdown width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                Select a Company
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownOption
                            v-for="model in models"
                            :key="model.id"
                            @click="() => $emit('selected', model)"
                        >
                            {{ model.name }}
                        </DropdownOption>
                    </template>
                </Dropdown>
            </div>
        </div>
    </div>
</template>
