<template>
    <section-card>
        <div
            class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 px-2 md:px-0"
        >
            <Link
                :href="route('quran.index')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <QuranIcon class="w-10" />
                <div class="text-center px-4">আল-কুরআন</div>
            </Link>
            <Link
                :href="route('hadith.index')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <HadithIcon class="w-10" />
                <div class="text-center px-4">আল-হাদীস</div>
            </Link>
            <Link
                :href="route('subjectwise.index')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <BookOpenIcon class="w-12" />
                <div class="text-center px-4">বিষয়ভিত্তিক আয়াত-হাদীস</div>
            </Link>
            <Link
                :href="route('article.index')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <PencilIcon class="w-10" />
                <div class="text-center px-4">প্রাত্যহিক জীবনে ইসলাম</div>
            </Link>
            <Link
                :href="route('ramadan-checklist.list')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <ShieldCheckIcon class="w-12" />
                <div class="text-center px-4">আমলের দিনলিপি</div>
            </Link>
            <Link
                :href="route('course.index')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <DesktopComputerIcon class="w-12" />
                <div class="text-center px-4">আমাদের কোর্স সমূহ</div>
            </Link>
            <Link
                :href="route('video.index')"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <VideoCameraIcon class="w-14" />
                <div class="text-center px-4">ভিডিও গ্যালারি</div>
            </Link>
            <Link
                :href="'#'"
                class="flex flex-col justify-center items-center bg-brand-primary text-white py-4 gap-4"
            >
                <PhotographIcon class="w-12" />
                <div class="text-center px-4">ফটো গ্যালারি</div>
            </Link>
        </div>
    </section-card>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import SectionCard from "@/Components/SectionCard.vue";
import QuranIcon from "@/Components/QuranIcon.vue";
import HadithIcon from "@/Components/HadithIcon.vue";
import {
    VideoCameraIcon,
    DesktopComputerIcon,
    BookOpenIcon,
    PhotographIcon,
    ShieldCheckIcon,
    PencilIcon,
} from "@heroicons/vue/outline";

export default {
    components: {
        Link,
        SectionCard,
        QuranIcon,
        HadithIcon,
        VideoCameraIcon,
        DesktopComputerIcon,
        BookOpenIcon,
        PhotographIcon,
        ShieldCheckIcon,
        PencilIcon,
    },
};
</script>
