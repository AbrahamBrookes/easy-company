import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Show from '@/Pages/Employee/Show.vue'

import fixtures from 'fixtures'

export default {
    title: 'Pages/Employee/Show',
    component: Show,
}

const Template = (args) => ({
    components: { Show, AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: `
        <AuthenticatedLayout :auth="auth">
            <Show :employee="employee" />
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
    employee: fixtures.employees[0]
}
