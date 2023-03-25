import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Show from '@/Pages/Company/Show.vue'

import fixtures from 'fixtures'

export default {
    title: 'Pages/Company/Show',
    component: Show,
}

const Template = (args) => ({
    components: { Show, AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: `
        <AuthenticatedLayout :auth="auth">
            <Show :company="company" />
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
    company: fixtures.companies[0]
}
