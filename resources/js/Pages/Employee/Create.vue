<script setup>
/**
 * The Create component is much the same as the Show component with just the form
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
import H2 from '@/Components/Elements/H2.vue';
import SelectModel from '@/Components/SelectModel.vue';

const props = defineProps({
    companies: {
        type: Array,
        required: true,
    },
    company: {
        type: Object,
        default: null,
    },
})

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    company_id: props.company ? props.company.id : null,
})

function save() {
    form.post(route('employees.store'), {
        preserveScroll: true,
        forceFormData: true
    })
}

function cancel() {
    router.visit(route('employees.index'))
}

const selectedCompany = ref(props.company ? props.company : null)
function companySelected(company) {
    form.company_id = company.id
    selectedCompany.value = company
}

</script>

<template>
    <Content>
        <Card>
            <div class="flex justify-between">
                <H2>
                    {{ form.name }}
                </H2>
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

                <div v-if="selectedCompany">
                    <div class="my-4">
                        <InputLabel for="company" value="Company" />
                        <div class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium leading-5 bg-green-100 text-green-800">
                                {{ selectedCompany.name }}
                            </span>
                        </div>
                    </div>
                </div>
                <SelectModel @selected="companySelected" :models="companies" label="Select a Company" />
                <InputError class="mt-2" :message="form.errors.company_id" />

                <div class="text-right mt-4">
                    <PrimaryButton
                        @click="save"
                        type="button"
                        class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150"
                    >
                        Save
                    </PrimaryButton>
                </div>
            </form>
        </Card>

        <div class="my-5 text-right">
            <button
                @click="cancel"
                type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-200 hover:bg-red-400 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-400 transition ease-in-out duration-150"
            >
                Cancel
            </button>
        </div>
    </Content>
</template>
