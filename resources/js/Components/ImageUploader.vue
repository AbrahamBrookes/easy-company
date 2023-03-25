<script setup>
/**
 * The ImageUploader is a combination of a file input and a preview image.
 *
 * We assume that the surrounding context uses an inertia form helper to
 * manage the image upload within the form of some model edit page. When
 * we emit the image, we expect the parent to handle the upload.
 */
import { ref, computed } from 'vue'

const emits = defineEmits(['file'])

const image = ref(null)
// if we have no image, we use a placeholder
const placeholder = 'https://via.placeholder.com/250/edeffb?text=Minimum+100x100'
// a display image to show in the preview
const displayImage = computed(() => image.value || placeholder)

const handleFileChange = (event) => {
    const file = event.target.files[0]
    emits('file', file)

    // FileReader the image into the preview src
    const reader = new FileReader()
    reader.onload = (e) => {
        image.value = e.target.result
    }
    reader.readAsDataURL(file)

}

</script>

<template>
    <div class="flex flex-col items-center">
        <img :src="displayImage" class="w-60 h-60 rounded-lg mb-0" />
        <input
            type="file"
            @change="handleFileChange"
            class="opacity-0 absolute w-full h-full inset-0 cursor-pointer"
        />
        <p class="text-sm text-indigo-400 dark:text-indigo-600 italic">Click to change image</p>
    </div>
</template>
