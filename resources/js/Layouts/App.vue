<template>
    <div>
        <app-header />

        <div
            v-if="$page.props.flash.status"
            class="my-2 p-2 text-green-600 text-center"
            v-html="$page.props.flash.status"
        ></div>

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
    methods: {
        checkImageLoding() {
            window.addEventListener("load", (event) => {
                const images = document.querySelectorAll("img");
                images.forEach((image) => {
                    const isLoaded =
                        image.complete && image.naturalHeight !== 0;

                    if (!isLoaded) {
                        image.src = "/images/article.jpg";
                    }
                });
            });
        },
    },
};
</script>
