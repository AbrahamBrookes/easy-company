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
    // this is a paginated resource on index, which laravel will always wrap
    companies: {
        data: fixtures.companies,
    }
}
