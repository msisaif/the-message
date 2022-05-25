<template>
    <app-layout>
        <section-card>
            <img class="w-full h-auto" src="/images/banner-course.png" />
        </section-card>

        <section-card
            v-if="false"
            title="Search Course Topic"
            class="mt-6 md:mt-12 bg-white py-4"
        >
            <div class="flex justify-center items-center px-2">
                <input
                    class="w-full max-w-sm border-2 border-brand-secondary px-2 py-1 focus:outline-none focus:ring-0 placeholder-brand-gray text-brand-primary"
                    placeholder="Search Topic"
                />
                <button
                    class="px-3 py-1 flex justify-center items-center gap-2 bg-brand-secondary text-white"
                    type="button"
                >
                    <search-icon class="h-6 w-6" />
                    <span class="text-xl font-medium">Search</span>
                </button>
            </div>
        </section-card>

        <section-card>
            <h1
                class="text-brand-primary my-6 text-lg md:text-3xl text-center font-bold"
            >
                আমাদের কোর্স সমূহ
            </h1>
            <div class="grid md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0">
                <Link
                    v-for="course in data.courses.data"
                    :key="course.id"
                    :href="route('course.show', course.id)"
                    class="border bg-white"
                >
                    <div class="overflow-hidden">
                        <img
                            :src="course.image"
                            class="w-full aspect-video object-cover hover:scale-110 transition-all ease-in-out"
                        />
                    </div>
                    <div class="flex flex-col gap-1 p-2 md:p-4">
                        <h3
                            class="shrink grow text-base text-brand-primary font-bold"
                        >
                            {{ course.title }}
                        </h3>
                        <hr class="my-1 shrink-0 grow-0" />
                        <div
                            class="shrink-0 grow-0 text-brand-black text-base text-justify"
                        >
                            <div class="flex justify-between items-center py-2">
                                <div
                                    class="px-3 py-1 text-brand-primary bg-brand-primary/10 font-semibold flex justify-center items-center gap-2"
                                >
                                    <span>৳</span>
                                    <span>
                                        {{
                                            course.amount
                                                ? course.amount
                                                : "Fee"
                                        }}
                                    </span>
                                </div>
                                <div
                                    class="text-sm px-4 py-1 text-brand-primary border border-brand-primary hover:bg-brand-primary hover:text-white"
                                >
                                    বিস্তারিত
                                </div>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </section-card>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import SectionCard from "@/Components/SectionCard.vue";

export default {
    components: {
        AppLayout,
        Link,
        Head,
        SectionCard,
    },
    props: {
        data: {
            type: Object,
            default: {},
        },
    },
};
</script>
