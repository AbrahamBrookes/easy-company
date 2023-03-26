import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Index from '@/Pages/Employee/Index.vue'

import fixtures from 'fixtures'

export default {
    title: 'Pages/Employee/Index',
    component: Index,
}

const Template = (args) => ({
    components: { Index, AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: `
        <AuthenticatedLayout :auth="auth">
            <Index :employees="employees" />
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
    employees: {
        data: fixtures.employees,
        meta: fixtures.pagination
    }
}
