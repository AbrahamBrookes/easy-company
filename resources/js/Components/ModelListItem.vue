<script setup>
const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
})
</script>
<template>
    <li class="pb-3 sm:pb-4">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                <slot name="image">
                    <img class="w-8 h-8" src="/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                </slot>
            </div>
            <div class="flex-1 min-w-0">
                <slot name="default">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    Neil Sims
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    email@flowbite.com
                    </p>
                </slot>
            </div>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <slot name="actions">
                    $320
                </slot>
            </div>
        </div>
    </li>
</template>
