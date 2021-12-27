<template>
    <section>
        <h2
            v-if="title"
            class="text-brand-primary text-xl font-bold text-center mb-4"
        >
            {{ title }}
        </h2>
        <slot />
    </section>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "",
        },
    },
};
</script>
