<template>
    <div class="">
        <!-- Header -->
        <app-header></app-header>

        <main class="w-full mx-auto max-w-content overflow-hidden min-h-content">
            <!-- Content -->
            <slot />
        </main>

        <app-footer></app-footer>
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
