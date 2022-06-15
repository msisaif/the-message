<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-sky-400 border border-transparent font-semibold text-base text-white uppercase tracking-widest hover:bg-sky-500 active:bg-sky-500 focus:outline-none focus:border-sky-500 focus:shadow-outline-sky transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: "submit",
        },
    },
};
</script>
