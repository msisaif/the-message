<template>
    <app-layout>
        <div class="mt-6 w-ful grid md:grid-cols-4 gap-4 px-4 md:px-0">
            <dashboard-card
                title="আমলের দিনলিপি"
                :href="route('checklist.list')"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                />
            </dashboard-card>
            <dashboard-card
                v-if="$page.props.auth.user.type === 1"
                title="Admins"
                :count="count.admin"
                :href="route('admins.index')"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </dashboard-card>
            <dashboard-card
                v-if="$page.props.auth.user.type === 1"
                title="Users"
                :count="count.user"
                :href="route('users.index')"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </dashboard-card>
            <dashboard-card
                v-if="$page.props.auth.user.type === 1"
                title="Sura"
                :count="count.sura"
                :href="route('suras.index')"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                />
            </dashboard-card>
            <dashboard-card
                v-if="$page.props.auth.user.type === 1"
                title="Post"
                :count="count.post"
                :href="route('posts.index')"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                />
            </dashboard-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import DashboardCard from "@/Components/DashboardCard.vue";

export default {
    components: {
        AppLayout,
        Link,
        DashboardCard,
    },
    props: {
        count: {
            type: Object,
            default: {},
        },
    },
};
</script>
