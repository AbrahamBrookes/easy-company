import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Create from '@/Pages/Company/Create.vue'

export default {
    title: 'Pages/Company/Create',
    component: Create,
}

const Template = (args) => ({
    components: { Create, AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: `
        <AuthenticatedLayout :auth="auth">
            <Create />
        </AuthenticatedLayout>
    `,
})

export const Default = Template.bind({})

Default.args = {
    auth: {
        user: {
            email: 'test@example.com',
            name: 'Test User',
        }
    },
}
