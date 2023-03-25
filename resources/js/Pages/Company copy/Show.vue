<script setup>
/**
 * The Show component is a form in a card where we can edit name, email, url
 */

import { ref, watchEffect } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

import Content from '@/Components/Content'
import Card from '@/Components/Elements/Card'
import InputError from '@/Components/Elements/InputError.vue';
import InputLabel from '@/Components/Elements/InputLabel.vue';
import TextInput from '@/Components/Elements/TextInput.vue';
import PrimaryButton from '@/Components/Elements/PrimaryButton.vue';
import ImageUploader from '@/Components/ImageUploader.vue';

const props = defineProps({
    company: {
        type: Array,
        required: true,
    },
})

const form = useForm({
    ...props.company,
    upload: null,
})

function save() {
    // uploading the form is using a put route but we need to use post and fudge the method
    form.transform((data) => ({
        ...data,
        _method: 'PUT',
    }))
    .post(route('companies.update', props.company.id), {
        preserveScroll: true,
        forceFormData: true
    })
}

function setFile(file) {
    form.upload = file
}

</script>

<template>
    <Content>
        <Card>
            <div class="flex justify-between">
                <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200">
                    {{ form.name }}
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
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-8">
                    <div class="md:col-span-2 sm:col-span-8 relative">
                        <ImageUploader :url="form.logo" @file="setFile" />
                        <InputError class="mt-2" :message="form.errors.upload" />
                    </div>
                    <div class="md:col-span-6 sm:col-span-8">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="name"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
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
                                <InputLabel for="website" value="Website" />

                                <TextInput
                                    id="website"
                                    type="website"
                                    class="mt-1 block w-full"
                                    v-model="form.website"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.website" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </Card>
    </Content>
</template>
