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
import H2 from '@/Components/Elements/H2.vue';
import SelectModel from '@/Components/SelectModel.vue';

import CompaniesList from '@/Components/Company/ModelList.vue';

const props = defineProps({
    employee: {
        type: Object,
        required: true,
    },
    companies: {
        type: Array,
        required: false,
    }
})

const form = useForm({
    ...props.employee,
})

function save() {
    form.put(route('employees.update', props.employee.id), {
        preserveScroll: true
    })
}

const selectedCompany = ref(props.company ? props.company : null)
function companySelected(company) {
    form.company_id = company.id
    form.company = company
    selectedCompany.value = company
}

function destroy() {
    if( ! confirm("Are you sure you want to delete this record?")) return

    form.delete(route('employees.destroy', props.employee.id), {
        preserveScroll: true
    })
}

</script>

<template>
    <Content>
        <Card>
            <div class="flex justify-between">
                <H2>
                    {{ form.first_name }} {{ form.last_name }}
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
                        />

                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                </div>
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

        <Card class="mt-5">
            <div v-if="form.company?.id">
                <H2>
                    {{ form.first_name }} {{ form.last_name }} works at:
                </H2>

                <CompaniesList :items="[form.company]" />
            </div>
            <div v-else>
                <H2>
                    {{ form.first_name }} {{ form.last_name }} does not work at any company
                </H2>

                <SelectModel @selected="companySelected" :models="companies" label="Select a Company" />
            </div>
        </Card>


        <div class="my-5 text-right">
            <button
                @click="destroy"
                type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-200 hover:bg-red-400 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-400 transition ease-in-out duration-150"
            >
                Delete this record
            </button>
        </div>
    </Content>
</template>
