<template>
    <button
        class="
            inline-flex
            items-center
            px-4 py-2
            bg-indigo-600 dark:bg-indigo-800
            border border-transparent
            rounded-md
            text-sm text-white
            hover:bg-indigo-700 dark:hover:bg-indigo-700
            focus:bg-indigo-700 dark:focus:bg-white active:bg-indigo-900 dark:active:bg-indigo-300
            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-indigo-800
            transition ease-in-out duration-150
        "
    >
        <slot />
    </button>
</template>
