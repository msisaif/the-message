<template>
    <footer class="mt-10">
        <div class="w-full bg-white py-6 px-2 md:px-0">
            <div class="mx-auto max-w-content grid md:grid-cols-5 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div class="flex justify-center md:justify-start">
                        <application-logo class="w-28" />
                    </div>
                    <p class="text-justify text-brand-gray">
                        Lorem ipsum dolor sit sed do ut magna. Lorem ipsum dolor
                        sit sed do ut magna. Lorem ipsum dolor sit sed do ut
                        magna. Lorem ipsum dolor sit sed do ut magna.
                    </p>
                </div>
                <div class="col-span-1 text-center md:text-right">
                    <h3 class="font-bold text-brand-dark">Menu</h3>
                    <div class="grid text-brand-gray">
                        <Link class="hover:text-brand-primary" href="/">
                            Home
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('quran.index')"
                        >
                            Al-Quran
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
                <div class="col-span-1 text-center md:text-right">
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
                    </div>
                </div>
                <div class="col-span-1 text-center md:text-right">
                    <h3 class="font-bold text-brand-dark">Contact Us</h3>
                    <div class="grid text-brand-gray space-y-1">
                        <p>info@messagebd.net</p>
                        <p>01000000000</p>
                        <div
                            class="
                                flex
                                justify-center
                                md:justify-end
                                items-center
                                gap-2
                            "
                        >
                            <Link href="https://facebook.com/">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24"
                                    height="27"
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
                            </Link>
                            <Link href="https://facebook.com/">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24"
                                    height="27"
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
                            </Link>
                            <Link href="https://facebook.com/">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24"
                                    height="27"
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
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-brand-primary py-6">
            <p class="text-center text-xs md:text-sm text-white">
                &copy; 2021 - {{ year }}
                <Link href="/" class="underline">MessageBD.com</Link>
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
