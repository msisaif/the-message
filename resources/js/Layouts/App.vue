<template>
    <div>
        <app-header />

        <main class="mx-auto max-w-content overflow-hidden min-h-content">
            <slot />
        </main>

        <app-footer />
    </div>
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
