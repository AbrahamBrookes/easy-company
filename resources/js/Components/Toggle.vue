<script setup>
/**
 * A toggle with a prop and an event.
 */
import { ref } from 'vue';

const props = defineProps({
    checked: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['update:checked']);

const checked = ref(false);

const toggle = () => {
    checked.value = !checked.value;
    emit('update:checked', checked.value);
};

</script>

<template>
	<label class="relative inline-flex items-center cursor-pointer">
		<input type="checkbox" v-model="checked" class="sr-only peer">
		<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
	</label>
</template>
