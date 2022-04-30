<template>
    <div class="py-2 px-2">
        <nav-link :href="route('home')" :active="route().current('home')">
            হোম
            <template #icon>
                <HomeIcon class="h-5 w-5" />
            </template>
        </nav-link>
        <nav-link
            :href="route('quran.index')"
            :active="route().current('quran.index')"
        >
            আল-কুরআন
            <template #icon>
                <QuranIcon class="h-5 w-5" />
            </template>
        </nav-link>
        <nav-link
            :href="route('hadith.index')"
            :active="route().current('hadith.index')"
        >
            আল-হাদীস
            <template #icon>
                <HadithIcon class="h-5 w-5" />
            </template>
        </nav-link>
        <nav-link
            :href="route('subjectwise.index')"
            :active="route().current('subjectwise.index')"
        >
            বিষয়ভিত্তিক আয়াত-হাদীস
            <template #icon>
                <BookOpenIcon class="h-5 w-5" />
            </template>
        </nav-link>
        <nav-link
            :href="route('ramadan-checklist.list')"
            :active="route().current('qramadan-checklist.list')"
        >
            আমলের দিনলিপি
            <template #icon>
                <ShieldCheckIcon class="h-5 w-5" />
            </template>
        </nav-link>
        <nav-link
            :href="route('article.index')"
            :active="route().current('article.index')"
        >
            প্রাত্যহিক জীবনে ইসলাম
            <template #icon>
                <PencilIcon class="h-5 w-5" />
            </template>
        </nav-link>
        <nav-link
            :href="route('course.index')"
            :active="route().current('course.index')"
        >
            আমাদের কোর্স সমূহ
            <template #icon>
                <DesktopComputerIcon class="h-5 w-5" />
            </template>
        </nav-link>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import NavLinkWrapper from "@/Components/NavLinkWrapper.vue";
import {
    HomeIcon,
    BookOpenIcon,
    PencilIcon,
    DesktopComputerIcon,
    ShieldCheckIcon,
} from "@heroicons/vue/outline";
import QuranIcon from "@/Components/QuranIcon.vue";
import HadithIcon from "@/Components/HadithIcon.vue";

export default {
    components: {
        NavLink,
        NavLinkWrapper,
        QuranIcon,
        HadithIcon,
        HomeIcon,
        BookOpenIcon,
        PencilIcon,
        DesktopComputerIcon,
        ShieldCheckIcon,
    },
};
</script>
