<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-brand-primary border border-transparent font-semibold text-base text-white uppercase tracking-widest hover:bg-brand-primary/90 active:bg-brand-primary/90 focus:outline-none focus:border-brand-primary/90 focus:shadow-outline-sky transition ease-in-out duration-150"
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
