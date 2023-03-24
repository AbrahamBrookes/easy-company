import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

export default {
    title: 'Layouts/AuthenticatedLayout',
    component: AuthenticatedLayout,
}

const Template = (args) => ({
    components: { AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: '<AuthenticatedLayout :auth="auth" />',
})

export const Default = Template.bind({})

Default.args = {
    auth: {
        user: {
            email: 'test@example.com',
            name: 'Test User',
        }
    }
}

export const NoUser = Template.bind({})
NoUser.args = {
    auth: null
}
