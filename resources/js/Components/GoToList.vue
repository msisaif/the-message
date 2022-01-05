<template>
    <span
        @click="goBack"
        class="text-center font-bold cursor-pointer border border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white px-3 py-1.5"
    >
        Go to list
    </span>
</template>

<script>
export default {
    props: {
        href: { type: String, default: "#" },
    },
    methods: {
        goBack() {
            this.$inertia.get(
                localStorage.getItem("historyOfList") || this.href
            );
        },
    },
};
</script>
