import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Dashboard from '@/Pages/Dashboard.vue'

export default {
    title: 'Pages/Dashboard',
    component: Dashboard,
}

const Template = (args) => ({
    components: { Dashboard, AuthenticatedLayout },
    setup() {
        return { ...args }
    },
    template: `
        <AuthenticatedLayout :auth="auth">
            <Dashboard :num-companies="numCompanies" :num-employees="numEmployees" />
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
    numCompanies: 100,
    numEmployees: 300,
}

export const NoUser = Template.bind({})
NoUser.args = {
    auth: null,
    numCompanies: 100,
    numEmployees: 300,
}
