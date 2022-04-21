<template>
    <footer class="mt-10">
        <div class="w-full bg-white py-3 md:py-6 px-2">
            <div
                class="mx-auto max-w-content grid grid-cols-2 lg:grid-cols-6 gap-6"
            >
                <div class="col-span-2 lg:col-span-3 space-y-4">
                    <div class="flex justify-center lg:justify-start">
                        <application-logo class="w-28" />
                    </div>
                    <p class="text-justify text-brand-gray">
                        The Message aims to ensure easy access to authentic
                        Islamic knowledge readily available to the Muslim world
                        through the Internet. Our goal is to enlighten people
                        through applied knowledge of Qur'an and Hadith and
                        ultimately to seek the pleasure of Almighty Allah.
                    </p>
                </div>
                <div class="col-span-1 text-right lg:text-right">
                    <h3 class="font-bold text-brand-dark">Menu</h3>
                    <div class="grid text-brand-gray">
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('quran.index')"
                        >
                            Quran
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('hadith.index')"
                        >
                            Hadith
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('course.index')"
                        >
                            Course
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('article.index')"
                        >
                            Article
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('kids-zone.index')"
                        >
                            Kids Zone
                        </Link>
                    </div>
                </div>
                <div class="col-span-1 text-left lg:text-right">
                    <h3 class="font-bold text-brand-dark">Organization</h3>
                    <div class="grid text-brand-gray">
                        <Link class="hover:text-brand-primary" href="/">
                            About Us
                        </Link>
                        <Link class="hover:text-brand-primary" href="/">
                            Privacy Policy
                        </Link>
                        <Link class="hover:text-brand-primary" href="/">
                            Terms &amp; Conditions
                        </Link>
                        <Link class="hover:text-brand-primary" href="/">
                            Donate Us
                        </Link>
                        <Link class="hover:text-brand-primary" href="/">
                            FAQs
                        </Link>
                    </div>
                </div>
                <div class="col-span-2 lg:col-span-1 text-center lg:text-right">
                    <h3 class="font-bold text-brand-dark">Contact Us</h3>
                    <div class="grid text-brand-gray space-y-1">
                        <p>info@messagebd.net</p>
                        <p>01736268035</p>
                        <div
                            class="flex justify-center md:justify-end items-center gap-2"
                        >
                            <a
                                target="_blank"
                                href="https://www.facebook.com/The-message-100448245654500"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    class="h-8"
                                    viewBox="0 0 24 27"
                                >
                                    <defs>
                                        <clipPath>
                                            <path
                                                d="M0,9.931a9.931,9.931,0,1,1,9.931,9.931A9.942,9.942,0,0,1,0,9.931Z"
                                                transform="translate(2 2)"
                                                fill="#1d71b8"
                                            />
                                        </clipPath>
                                    </defs>
                                    <rect width="24" height="24" fill="none" />
                                    <g>
                                        <path
                                            d="M0,9.931a9.931,9.931,0,1,1,9.931,9.931A9.942,9.942,0,0,1,0,9.931Z"
                                            transform="translate(2 2)"
                                            fill="#1d71b8"
                                        />
                                        <g clip-path="url(#clip-path)">
                                            <g>
                                                <rect
                                                    width="24"
                                                    height="24"
                                                    fill="none"
                                                />
                                                <rect
                                                    width="24"
                                                    height="24"
                                                    fill="#1d71b8"
                                                />
                                            </g>
                                        </g>
                                    </g>
                                    <text
                                        transform="translate(9.5 21)"
                                        fill="#fff"
                                        font-size="17"
                                        font-family="Poppins-Regular, Poppins"
                                    >
                                        <tspan x="0" y="0">f</tspan>
                                    </text>
                                </svg>
                            </a>
                            <a
                                target="_blank"
                                href="https://www.youtube.com/channel/UCdI8KP81QVE8jlG6PNzGXeA"
                                class="w-6 h-5 rounded bg-rose-600 text-white flex justify-center items-center pl-1 text-xs"
                            >
                                &#9654;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-brand-primary py-6">
            <p class="text-center text-xs md:text-sm text-white">
                &copy; 2021 - {{ year }}
                <Link href="/" class="underline">messagebd.net</Link>
                | All right reserved
            </p>
        </div>
    </footer>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
export default {
    components: {
        Link,
        ApplicationLogo,
    },
    created() {
        this.year = new Date().getFullYear();
    },
    data() {
        return {
            year: "",
        };
    },
};
</script>
