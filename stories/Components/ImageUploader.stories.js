import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ImageUploader from '@/Components/ImageUploader.vue'

export default {
    title: 'Components/ImageUploader',
    component: ImageUploader,
}

const Template = (args) => ({
    components: { ImageUploader },
    setup() {
        return { ...args }
    },
    template: `
        <div style="max-width: 350px; position: absolute; left: 0; right: 0;">
            <ImageUploader />
        </div>
    `,
})

export const Default = Template.bind({})

Default.args = {
}
