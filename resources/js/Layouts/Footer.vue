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
                    <p class="text-justify text-brand-black">
                        ‘দ্যা ম্যাসেজ’ এর লক্ষ্য কুরআন-হাদীসের জ্ঞানকে সহজবোধ্য,
                        সহজলভ্য ও আকর্ষণীয় করে উপস্থাপন করা। যাতে ধর্ম-বর্ণ,
                        শ্রেণি-পেশা নির্বিশেষে সকল মানুষ ইসলামের সঠিক জ্ঞান
                        অর্জন করে নিজেকে সমৃদ্ধ করতে পারে। কুরআন-হাদীসের
                        প্রায়োগিক জ্ঞান অর্জন ও নিজের জীবনে তা চর্চার মধ্য দিয়ে
                        আলোকিত ও কল্যাণময় সমাজ গড়ে উঠবে বলে আমরা বিশ্বাস করি।
                    </p>
                </div>
                <div class="col-span-1 text-right lg:text-right">
                    <h3 class="font-bold text-brand-primary">লিংক</h3>
                    <div class="grid text-brand-black gap-1">
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('quran.index')"
                        >
                            ‍আল-কুরআন
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('hadith.index')"
                        >
                            আল-হাদিস
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('course.index')"
                        >
                            সকল কোর্স
                        </Link>
                        <Link
                            class="hover:text-brand-primary"
                            :href="route('video.index')"
                        >
                            ভিডিও
                        </Link>
                    </div>
                </div>
                <div class="col-span-1 text-left lg:text-right">
                    <h3 class="font-bold text-brand-primary">অন্যান্য</h3>
                    <div class="grid text-brand-black gap-1">
                        <Link class="hover:text-brand-primary" href="#">
                            আমাদের সম্পর্কে
                        </Link>
                        <Link class="hover:text-brand-primary" href="#">
                            প্রাইভেসি পলিসি
                        </Link>
                        <Link class="hover:text-brand-primary" href="#">
                            দান করুন
                        </Link>
                        <Link class="hover:text-brand-primary" href="#">
                            প্রশ্নোত্তর
                        </Link>
                    </div>
                </div>
                <div class="col-span-2 lg:col-span-1 text-center lg:text-right">
                    <h3 class="font-bold text-brand-primary">যোগাযোগ</h3>
                    <div class="grid text-brand-black gap-2">
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
