<template>
    <section-card class="mt-4 bg-white py-4" title="Search Anything">
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
                placeholder="Search Anything..."
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
</template>

<script>
import SectionCard from "./SectionCard.vue";

export default {
    components: {
        SectionCard,
    },
};
</script>
