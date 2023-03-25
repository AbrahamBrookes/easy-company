<script setup>
/**
 * The Show component is a form in a card where we can edit name, email, url
 */

import { ref, watchEffect } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

import Content from '@/Components/Content'
import Card from '@/Components/Card'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    employee: {
        type: Array,
        required: true,
    },
})

const form = useForm({
    ...props.employee,
})

function save() {
    form.put(route('employees.update', props.employee.id), {
        preserveScroll: true
    })
}

</script>

<template>
    <Content>
        <Card>
            <div class="flex justify-between">
                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200">
                    {{ form.first_name }} {{ form.last_name }}
                </h2>
                <div class="flex">
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150"
                    >
                        Delete
                    </button>
                    <button
                        @click="save"
                        type="button"
                        class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150"
                    >
                        Save
                    </button>
                </div>
            </div>

            <form class="mt-4" @submit.stop.prevent="save">
                <input type="submit" class="hidden" />
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <InputLabel for="first_name" value="First Name" />

                        <TextInput
                            id="first_name"
                            type="first_name"
                            class="mt-1 block w-full"
                            v-model="form.first_name"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.first_name" />
                    </div>
                    <div>
                        <InputLabel for="last_name" value="Last Name" />

                        <TextInput
                            id="last_name"
                            type="last_name"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.last_name" />
                    </div>
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Phone" />

                        <TextInput
                            id="phone"
                            type="phone"
                            class="mt-1 block w-full"
                            v-model="form.phone"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                </div>
            </form>

        </Card>
    </Content>
</template>
