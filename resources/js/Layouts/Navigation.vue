<template>
    <div class="p-4">
        <nav-link :href="route('home')" :active="route().current('home')">
            Home
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                />
            </template>
        </nav-link>
        <nav-link
            :href="route('ramadan-checklist.list')"
            :active="route().current('qramadan-checklist.list')"
        >
            Ramadan Checklist
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                />
            </template>
        </nav-link>
        <nav-link
            :href="route('quran.index')"
            :active="route().current('quran.index')"
        >
            Quran Reading
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                />
            </template>
        </nav-link>
        <nav-link
            :href="route('hadith.index')"
            :active="route().current('hadith.index')"
        >
            Hadith Reading
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                />
            </template>
        </nav-link>
        <nav-link
            :href="route('article.index')"
            :active="route().current('article.index')"
        >
            Article Reading
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                />
            </template>
        </nav-link>
        <nav-link
            :href="route('course.index')"
            :active="route().current('course.index')"
        >
            Course
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
            </template>
        </nav-link>
        <nav-link
            :href="route('kids-zone.index')"
            :active="route().current('kids-zone.index')"
        >
            KidsZone
            <template #icon>
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
            </template>
        </nav-link>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import NavLinkWrapper from "@/Components/NavLinkWrapper.vue";

export default {
    components: {
        NavLink,
        NavLinkWrapper,
    },
};
</script>
