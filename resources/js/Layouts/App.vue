<template>
    <!-- Header -->
    <app-header></app-header>

    <main class="w-full mx-auto max-w-6xl overflow-hidden">
        <!-- Content -->
        <slot />
    </main>

    <app-footer></app-footer>
</template>

<script>
import AppHeader from "./Header.vue";
import AppFooter from "./Footer.vue";

export default {
    components: {
        AppHeader,
        AppFooter,
    },
};
</script>
