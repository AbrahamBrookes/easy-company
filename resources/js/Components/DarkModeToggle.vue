<script setup>
import { ref, watch, onMounted } from 'vue';
import { SunIcon, MoonIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    checked: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['update:checked']);

const _checked = ref(props.checked);

const toggleTo = (val) => {
    emit('update:checked', _checked.value);

    if (_checked.value) {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark'
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light'
    }
};

// every time _checked changes, call toggleTo
watch(_checked, (val) => {
    toggleTo(val);
});

// on mounted, cehck if the class exists and set _checked
onMounted(() => {
    if (document.documentElement.classList.contains('dark')) {
        _checked.value = true;
    }
});

</script>

<template>
	<label class="relative inline-flex items-center cursor-pointer scale-125">
        <MoonIcon class="p-[4px] w-6 h-6 text-blue-500 transition-all dark:opacity-100 opacity-0" />
        <SunIcon class="p-[2px] w-6 h-6 text-yellow-500 transition-all dark:opacity-0 opacity-100" />
		<input type="checkbox" v-model="_checked" class="sr-only peer">
		<div class="rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
	</label>
</template>
