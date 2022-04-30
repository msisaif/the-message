<template>
    <app-layout>
        <div class="w-full">
            <img src="/images/donate.png" alt="" class="w-full" />
        </div>

        <div class="my-6 md:my-16 space-y-1">
            <h2
                class="text-center text-brand-primary text-3xl md:text-4xl font-bold"
            >
                Exclusively Streaming
            </h2>
            <p class="text-center text-brand-dark text-xs md:text-base">
                These Cartoons have been formulated by eminent Shaykhs of the
                country
            </p>
        </div>

        <div class="space-y-6 md:space-y-20 px-2 md:px-0">
            <div class="grid md:grid-cols-2 gap-10">
                <div class="space-y-1">
                    <h3
                        class="text-brand-primary text-xl md:text-2xl font-bold"
                    >
                        Why Donate Us?
                    </h3>
                    <p
                        class="text-justify text-brand-gray text-base md:text-xl leading-loose"
                    >
                        ইসলামের প্রচার ও প্রসারের লক্ষ্যকে সামনে রেখে কাজ করে
                        যাচ্ছে ইন্সটিটিউট অব সেলফ ডেভেলপমেন্ট। কুরআন-হাদীসের
                        জ্ঞানকে সহজবোধ্য, সহজলভ্য ও আকর্ষণীয় করার লক্ষ্যে
                        নানামুখী কার্যক্রম চালিয়ে যাচ্ছে এভিআর। যাতে ধর্ম-বর্ণ,
                        শ্রেণি-পেশা নির্বিশেষে সকল মানুষ ইসলামের সঠিক জ্ঞান
                        অর্জন করে নিজেকে সমৃদ্ধ করতে পারে। ইসলামের সঠিক জ্ঞান
                        চর্চার মাধ্যমেই সমাজ পরিবর্তন ও মানবকল্যাণ করা সম্ভব বলে
                        আমরা মনে করি।
                    </p>
                </div>
                <div class="order-2">
                    <img class="w-full" src="/images/donate_why.png" />
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-10">
                <div class="space-y-1 md:order-2">
                    <h3
                        class="text-brand-primary text-xl md:text-2xl font-bold"
                    >
                        Where your donation will be spent?
                    </h3>
                    <p
                        class="text-justify text-brand-gray text-xs md:text-base"
                    >
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna. Lorem
                        ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit
                        sed do ut magna. Lorem ipsum dolor sit sed do ut magna.
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna. Lorem
                        ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit
                        sed do ut magna. Lorem ipsum dolor sit sed do ut magna.
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna. Lorem
                        ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit
                        sed do ut magna. Lorem ipsum dolor sit sed do ut magna.
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna.
                    </p>
                </div>
                <div class="order-2 md:order-1">
                    <img class="w-full" src="/images/donate_where.png" />
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                <div class="space-y-1">
                    <h3
                        class="text-brand-primary text-xl md:text-2xl font-bold"
                    >
                        How to donate?
                    </h3>
                    <p
                        class="text-justify text-brand-gray text-xs md:text-base"
                    >
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna. Lorem
                        ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit
                        sed do ut magna. Lorem ipsum dolor sit sed do ut magna.
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna. Lorem
                        ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit
                        sed do ut magna. Lorem ipsum dolor sit sed do ut magna.
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna. Lorem
                        ipsum dolor sit sed do ut magna. Lorem ipsum dolor sit
                        sed do ut magna. Lorem ipsum dolor sit sed do ut magna.
                    </p>
                </div>
                <div class="">
                    <img class="w-full" src="/images/donate_how.png" />
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-6 md:mt-12">
            <Link
                class="px-6 py-2 border-2 border-brand-primary text-center text-brand-primary font-bold text-lg hover:bg-brand-primary hover:text-white"
                >Donate Now</Link
            >
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        Link,
    },
};
</script>
