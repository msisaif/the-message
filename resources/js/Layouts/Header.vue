<template>
    <header class="bg-white w-full p-2 z-40">
        <div
            class="
                w-full
                max-w-content
                mx-auto
                h-12
                md:h-16
                py-2
                flex
                justify-between
                items-center
            "
        >
            <Link href="/" class="h-full">
                <application-logo class="h-full" />
            </Link>

            <bismillahir-rahmanir-rahim class="h-full" />

            <div class="min-w-max flex items-center">
                <!-- Settings Dropdown -->
                <div v-if="!$page.props.auth.user">
                    <Link
                        :href="route('login')"
                        class="
                            px-3
                            md:px-6
                            py-0.5
                            md:py-1.5
                            border border-brand-primary
                            text-brand-primary
                            hover:bg-brand-primary hover:text-white
                        "
                        >Join</Link
                    >
                </div>
                <div v-else class="relative">
                    <dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="
                                        inline-flex
                                        items-center
                                        gap-1
                                        text-sm
                                        font-medium
                                        border border-brand-primary
                                        text-brand-primary
                                        hover:bg-brand-primary
                                        hover:text-white
                                        hover:
                                        focus:outline-none
                                        px-2
                                        py-0.5
                                        md:py-1.5
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span
                                        class="hidden sm:block"
                                        v-if="$page.props.auth.user"
                                    >
                                        {{ $page.props.auth.user.name }}
                                    </span>
                                    <svg
                                        class="w-3.5"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 14.3 8.176"
                                    >
                                        <path
                                            d="M13.34,16.958l5.407-5.411a1.018,1.018,0,0,1,1.443,0,1.03,1.03,0,0,1,0,1.448l-6.127,6.131a1.02,1.02,0,0,1-1.409.03L6.486,13a1.022,1.022,0,0,1,1.443-1.448Z"
                                            transform="translate(-6.188 -11.246)"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <dropdown-link
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </dropdown-link>
                        </template>
                    </dropdown>
                </div>
            </div>
        </div>

        <nav
            class="
                w-full
                max-w-content
                mx-auto
                flex
                items-center
                justify-between
                relative
                gap-2
            "
        >
            <div class="flex items-center">
                <!-- Hamburger -->
                <svg
                    @click="
                        showingNavigationDropdown = !showingNavigationDropdown
                    "
                    class="
                        w-6
                        h-6
                        md:w-8 md:h-8
                        text-brand-primary
                        cursor-pointer
                    "
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 42 26"
                >
                    <rect
                        width="42"
                        height="3"
                        transform="translate(0 0)"
                        fill="currentColor"
                    />
                    <rect
                        width="42"
                        height="3"
                        transform="translate(0 12)"
                        fill="currentColor"
                    />
                    <rect
                        width="42"
                        height="3"
                        transform="translate(0 23)"
                        fill="currentColor"
                    />
                </svg>

                <div
                    class="
                        absolute
                        top-full
                        ring-0
                        left-0
                        w-full
                        md:max-w-max
                        overflow-hidden
                        z-30
                        py-2
                    "
                >
                    <!-- Navigation Menu -->
                    <div
                        class="overflow-auto bg-white shadow"
                        :class="{
                            block: showingNavigationDropdown,
                            hidden: !showingNavigationDropdown,
                        }"
                    >
                        <navigation />
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-end items-center gap-2">
                <navigation-link
                    :href="route('home')"
                    :active="route().current('home')"
                    class="hidden md:flex"
                >
                    Home
                </navigation-link>

                <navigation-link
                    :href="route('quran.index')"
                    :active="route().current('quran.*')"
                >
                    Al-Quran
                </navigation-link>

                <navigation-link
                    :href="route('hadith.index')"
                    :active="route().current('hadith.*')"
                >
                    Hadith
                </navigation-link>

                <navigation-link
                    :href="route('article.index')"
                    :active="route().current('article.*')"
                >
                    Article
                </navigation-link>

                <navigation-link
                    :href="route('kids-zone.index')"
                    :active="route().current('kids-zone.*')"
                >
                    Kids Zone
                </navigation-link>
            </div>
        </nav>
    </header>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Navigation from "./Navigation.vue";
import BismillahirRahmanirRahim from "@/Components/BismillahirRahmanirRahim.vue";
import NavigationLink from "@/Components/NavigationLink.vue";

export default {
    components: {
        ApplicationLogo,
        Dropdown,
        DropdownLink,
        NavLink,
        Link,
        Navigation,
        BismillahirRahmanirRahim,
        NavigationLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>
