import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Index from '@/Pages/Company/Index.vue'

import fixtures from 'fixtures'

export default {
    title: 'Pages/Company/Index',
    component: Index,
}

const Template = (args) => ({
    components: { Index, AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: `
        <AuthenticatedLayout :auth="auth">
            <Index :companies="companies" />
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
    companies: fixtures.companies,
}
