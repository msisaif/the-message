<template>
    <Head title="বিষয়ভিত্তিক আয়াত হাদিস" />
    <app-layout>
        <section-card class="mt-6" title="বিষয়ভিত্তিক আয়াত হাদিস">
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <div
                    v-for="(category, index) in categories.data"
                    :key="index"
                    class="bg-white shadow"
                >
                    <Link
                        :href="route('subjectwise.show', category.id)"
                        class="flex justify-center items-center gap-2 py-8"
                    >
                        <span
                            class="text-sm md:text-lg text-center text-brand-black font-bold"
                        >
                            {{ category.name }}
                        </span>
                    </Link>
                </div>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import SectionCard from "@/Components/SectionCard.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppLayout,
        SectionCard,
        Head,
        Link,
    },
    props: {
        categories: {
            type: Object,
            default: {},
        },
    },
};
</script>
