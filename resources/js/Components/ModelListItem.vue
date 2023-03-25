<script setup>
import Link from '@/Components/Elements/Link'

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    href: {
        type: String,
        default: null,
    },
})
</script>
<template>
    <li class="py-2 sm:py-3">
        <component :is="href ? Link : 'div'" class="flex items-center space-x-4 no-underline" :href="href">
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
        </component>
    </li>
</template>
