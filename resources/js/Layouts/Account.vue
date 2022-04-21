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
                    <nav-link
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Dashboard
                    </nav-link>
                    <nav-link
                        :href="route('ramadan-checklist.list')"
                        :active="route().current('ramadan-checklist.list')"
                    >
                        শেষ দশকের রামাদান
                    </nav-link>

                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('admins.index')"
                        :active="route().current('admins.*')"
                    >
                        Admins
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('users.index')"
                        :active="route().current('users.*')"
                    >
                        Users
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('suras.index')"
                        :active="route().current('suras.*')"
                    >
                        Suras
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('classifications.index')"
                        :active="route().current('classifications.*')"
                    >
                        Classifications
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('categories.index')"
                        :active="route().current('categories.*')"
                    >
                        Categories
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('checklist-fields.index')"
                        :active="route().current('checklist-fields.*')"
                    >
                        Checklist Field
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('videos.index')"
                        :active="route().current('videos.*')"
                    >
                        Videos
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('juzs.index')"
                        :active="route().current('juzs.*')"
                    >
                        Juzs
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('ayahs.index')"
                        :active="route().current('ayahs.*')"
                    >
                        Ayahs
                    </nav-link>
                    <nav-link
                        v-if="$page.props.auth.user.type === 1"
                        :href="route('posts.index')"
                        :active="route().current('posts.*')"
                    >
                        Posts
                    </nav-link>
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

export default {
    components: {
        Dropdown,
        DropdownLink,
        Link,
        NavLink,
    },
};
</script>
