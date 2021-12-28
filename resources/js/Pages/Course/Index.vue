<template>
    <app-layout>
        <section-card>
            <img class="w-full h-auto" src="/images/banner-course.png" />
        </section-card>

        <section-card
            title="Search Course Topic"
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
import SectionCard from "@/Components/SectionCard.vue";

export default {
    components: {
        AppLayout,
        SectionCard,
    },
};
</script>
