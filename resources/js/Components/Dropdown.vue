<template>
    <div class="relative">
        <div @click="open = !open" class="cursor-pointer">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div
            v-show="open"
            class="fixed inset-0 z-40"
            @click="open = false"
        ></div>

        <div
            v-show="open"
            class="absolute z-50 mt-2 shadow-lg"
            :class="[widthClass, alignmentClasses]"
            style="display: none"
            @click="open = false"
        >
            <div
                class="ring-1 ring-black ring-opacity-5"
                :class="contentClasses"
            >
                <slot name="content" />
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, onUnmounted, ref } from "vue";

export default {
    props: {
        align: {
            default: "right",
        },
        width: {
            default: "48",
        },
        contentClasses: {
            default: () => ["bg-white"],
        },
    },

    setup() {
        let open = ref(false);

        const closeOnEscape = (e) => {
            if (open.value && e.keyCode === 27) {
                open.value = false;
            }
        };

        onMounted(() => document.addEventListener("keydown", closeOnEscape));
        onUnmounted(() =>
            document.removeEventListener("keydown", closeOnEscape)
        );

        return {
            open,
        };
    },

    computed: {
        widthClass() {
            return {
                48: "w-48",
            }[this.width.toString()];
        },

        alignmentClasses() {
            if (this.align === "left") {
                return "origin-top-left left-0";
            } else if (this.align === "right") {
                return "origin-top-right right-0";
            } else {
                return "origin-top";
            }
        },
    },
};
</script>
