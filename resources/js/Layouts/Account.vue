<template>
    <div class="min-w-max flex items-center">
        <!-- Settings Dropdown -->
        <div v-if="!$page.props.auth.user">
            <Link
                :href="route('login')"
                class="px-3 md:px-6 py-0.5 md:py-1.5 border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-bold"
            >
                Join
            </Link>
        </div>
        <div v-else class="relative">
            <dropdown align="right" width="60">
                <template #trigger>
                    <span class="inline-flex">
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 text-sm font-medium border border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white hover: focus:outline-none px-2 py-0.5 md:py-1.5"
                        >
                            <avatar-photo-view
                                :imageUrl="$page.props.auth.user.avatar"
                                :firstLatter="$page.props.auth.user.name[0]"
                                class="w-8 text-lg bg-brand-primary text-white border border-white"
                            />
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
                    <nav-link
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        ড্যাশবোর্ড
                    </nav-link>
                    <nav-link
                        :href="route('checklist.list')"
                        :active="route().current('checklist.list')"
                    >
                        আমলের দিনলিপি
                    </nav-link>
                    <hr />
                    <div
                        class="grid bg-gray-100 pl-2"
                        v-if="$page.props.auth.user.type === 1"
                    >
                        <nav-link
                            :href="route('admins.index')"
                            :active="route().current('admins.*')"
                        >
                            <template #icon>
                                <UsersIcon class="w-5" />
                            </template>
                            Admins
                        </nav-link>
                        <nav-link
                            :href="route('users.index')"
                            :active="route().current('users.*')"
                        >
                            <template #icon>
                                <UserGroupIcon class="w-5" />
                            </template>
                            ইউজার তালিকা
                        </nav-link>
                        <!-- <nav-link
                            :href="route('suras.index')"
                            :active="route().current('suras.*')"
                        >
                            Suras
                        </nav-link> -->
                        <nav-link
                            :href="route('classifications.index')"
                            :active="route().current('classifications.*')"
                        >
                            <template #icon>
                                <BookOpenIcon class="w-5" />
                            </template>
                            আয়াতের বিষয়বস্তু
                        </nav-link>
                        <nav-link
                            :href="route('categories.index')"
                            :active="route().current('categories.*')"
                        >
                            <template #icon>
                                <ViewGridIcon class="w-5" />
                            </template>
                            বিষয় তালিকা
                        </nav-link>
                        <nav-link
                            :href="route('subjectwises.index')"
                            :active="route().current('subjectwises.*')"
                        >
                            <template #icon>
                                <BookOpenIcon class="w-5" />
                            </template>
                            বিষয়ভিত্তিক আয়াত-হাদিস
                        </nav-link>
                        <nav-link
                            :href="route('videos.index')"
                            :active="route().current('videos.*')"
                        >
                            <template #icon>
                                <VideoCameraIcon class="w-5" />
                            </template>
                            সাম্প্রতিক ভিডিও
                        </nav-link>
                        <!-- <nav-link
                            :href="route('juzs.index')"
                            :active="route().current('juzs.*')"
                        >
                            Juzs
                        </nav-link> -->
                        <!-- <nav-link
                            :href="route('ayahs.index')"
                            :active="route().current('ayahs.*')"
                        >
                            Ayahs
                        </nav-link> -->
                        <nav-link
                            :href="route('posts.index')"
                            :active="route().current('posts.*')"
                        >
                            <template #icon>
                                <PencilIcon class="w-5" />
                            </template>
                            প্রাত্যহিক জীবনে ইসলাম
                        </nav-link>
                        <nav-link
                            :href="route('checklist-fields.index')"
                            :active="route().current('checklist-fields.*')"
                        >
                            <template #icon>
                                <QuestionMarkCircleIcon class="w-5" />
                            </template>
                            আমলের দিনলিপি এর প্রশ্ন
                        </nav-link>
                        <nav-link
                            :href="route('courses.index')"
                            :active="route().current('courses.*')"
                        >
                            <template #icon>
                                <DesktopComputerIcon class="w-5" />
                            </template>
                            কোর্স
                        </nav-link>
                    </div>
                    <hr />
                    <dropdown-link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="text-red-500 flex justify-center items-center gap-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            />
                        </svg>
                        <span>Log Out</span>
                    </dropdown-link>
                </template>
            </dropdown>
        </div>
    </div>
</template>

<script>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import NavLink from "@/Components/NavLink.vue";
import {
    UserGroupIcon,
    VideoCameraIcon,
    PencilIcon,
    QuestionMarkCircleIcon,
    ViewGridIcon,
    BookOpenIcon,
    DesktopComputerIcon,
    UsersIcon,
} from "@heroicons/vue/outline";
import AvatarPhotoView from "@/Components/AvatarPhotoView.vue";

export default {
    components: {
        Dropdown,
        DropdownLink,
        Link,
        NavLink,
        UserGroupIcon,
        VideoCameraIcon,
        PencilIcon,
        QuestionMarkCircleIcon,
        ViewGridIcon,
        BookOpenIcon,
        DesktopComputerIcon,
        UsersIcon,
        AvatarPhotoView,
    },
};
</script>
