<template>
    <app-layout>
        <splash-banner>
            <img
                class="w-full"
                src="/images/banner-kids-zone.png"
                alt="banner"
            />
        </splash-banner>

        <section-card
            title="Search Kids Items"
            class="mt-6 md:mt-12 bg-white py-4"
        >
            <div class="flex justify-center items-center px-2">
                <input
                    class="
                        w-full
                        max-w-sm
                        border-2 border-brand-secondary
                        px-2
                        py-1
                        focus:outline-none focus:ring-0
                        placeholder-brand-gray
                        text-brand-primary
                    "
                    placeholder="Search Topic"
                />
                <button
                    class="
                        px-3
                        py-1
                        flex
                        justify-center
                        items-center
                        gap-2
                        bg-brand-secondary
                        text-white
                    "
                    type="button"
                >
                    <search-icon class="h-6 w-6" />
                    <span class="text-xl font-medium">Search</span>
                </button>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import SplashBanner from "@/Components/SplashBanner.vue";
import SectionCard from "@/Components/SectionCard.vue";

export default {
    components: {
        AppLayout,
        SplashBanner,
        SectionCard,
    },
};
</script>
