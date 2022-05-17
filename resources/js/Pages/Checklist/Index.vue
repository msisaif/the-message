<template>
    <app-layout>
        <div class="bg-white p-2 md:p-4 mt-2 md:mt-4">
            <div class="flex justify-center items-center gap-x-4">
                <div>
                    <Link
                        :href="route('checklist.list', data.prevMonth.value)"
                        class="border border-brand-primary rounded-md text-brand-primary flex justify-center items-center px-3 py-1.5 gap-2"
                    >
                        <ArrowLeftIcon class="w-6" />
                        <span class="hidden md:block">
                            {{ data.prevMonth.title }}
                        </span>
                    </Link>
                </div>
                <h3
                    class="text-center text-lg md:text-2xl text-brand-primary my-3 flex flex-wrap justify-center items-center gap-x-2 md:mx-auto"
                >
                    <span class="font-bold">আমলের দিনলিপি</span>
                    <span> ({{ data.currentMonth.title }})</span>
                </h3>
                <div>
                    <Link
                        :href="route('checklist.list', data.nextMonth.value)"
                        class="border border-brand-primary rounded-md text-brand-primary flex justify-center items-center px-3 py-1.5 gap-2"
                    >
                        <span class="hidden md:block">
                            {{ data.nextMonth.title }}
                        </span>
                        <ArrowRightIcon class="w-5" />
                    </Link>
                </div>
            </div>
            <div
                v-if="$page.props.auth.user"
                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-6 my-3"
            >
                <div>
                    Name: <b>{{ $page.props.auth.user.name }}</b>
                </div>
                <div>
                    Email: <b>{{ $page.props.auth.user.email }}</b>
                </div>
            </div>
            <div class="flex justify-center items-center gap-4">
                <Link
                    :href="route('checklist.form')"
                    class="border border-brand-primary rounded-md bg-brand-primary text-white flex justify-center items-center px-4 py-1.5 gap-2"
                >
                    <ShieldCheckIcon class="w-6" />
                    <span>চেকলিস্ট</span>
                </Link>
            </div>
            <div>
                <table class="w-full border border-gray-300 mt-4">
                    <tr>
                        <th class="text-left py-1 px-2 bg-gray-200">
                            কাজের বিবরণ
                        </th>
                        <th
                            v-for="(
                                column, columnIndex
                            ) in data.checkListColumns"
                            :key="columnIndex"
                            class="text-center py-1 px-2 border-l border-gray-300 hidden md:table-cell bg-gray-200"
                        >
                            {{ column.title }}
                        </th>
                        <th
                            class="bg-gray-200 first-letter: text-center py-1 px-2 border-l border-gray-300"
                        >
                            মোট
                        </th>
                    </tr>
                    <tr
                        v-for="(item, itemIndex) in data.checkListFields"
                        :key="itemIndex"
                    >
                        <th
                            class="text-left py-1 px-2 border-t border-gray-300"
                        >
                            {{ item.name }}
                        </th>
                        <td
                            v-for="(
                                column, columnIndex
                            ) in data.checkListColumns"
                            :key="columnIndex"
                            class="text-center py-1 px-2 border-t border-l border-gray-300 hidden md:table-cell"
                        >
                            {{ data.userChecklist[columnIndex] }}
                            <!-- <span v-if="item.type == 'number'">
                                {{
                                    form.checkList[columnIndex]["works"][
                                        itemIndex
                                    ]["value"]
                                }}
                            </span>
                            <span v-if="item.type == 'radio'">
                                <span
                                    v-if="
                                        form.checkList[columnIndex]['works'][
                                            itemIndex
                                        ]['value'] === '1'
                                    "
                                >
                                    হ্যাঁ
                                </span>
                                <span
                                    v-if="
                                        form.checkList[columnIndex]['works'][
                                            itemIndex
                                        ]['value'] === '0'
                                    "
                                >
                                    না
                                </span>
                            </span> -->
                        </td>
                        <th
                            class="text-center py-1 px-2 border-t border-l border-gray-300"
                        >
                            <!-- {{ checkListSubtotal(item.id) }} -->
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Select from "@/Components/Select.vue";
import Label from "@/Components/Label.vue";
import {
    ShieldCheckIcon,
    ArrowRightIcon,
    ArrowLeftIcon,
} from "@heroicons/vue/outline";
export default {
    components: {
        AppLayout,
        Link,
        ShieldCheckIcon,
        ArrowRightIcon,
        ArrowLeftIcon,
        Select,
        Label,
    },
    created() {
        // this.checkListFields = this.data.checkListFields;
        // this.checkListColumns = this.data.checkListColumns;
        // this.checkListColumns.forEach((column) => {
        //     let selectedData = Object.values(this.data.userChecklist).filter(
        //         (list) => {
        //             return list.date == column.date;
        //         }
        //     )[0];
        //     let array = [];
        //     Object.values(this.checkListFields).forEach((item) => {
        //         let selectedDataForSelectedDate;
        //         if (selectedData) {
        //             selectedDataForSelectedDate = Object.values(
        //                 selectedData.checklist
        //             ).filter((check) => {
        //                 return check.id == item.id;
        //             })[0];
        //         }
        //         array.push({
        //             id: item.id,
        //             value: selectedDataForSelectedDate
        //                 ? selectedDataForSelectedDate.value
        //                 : "", // current value
        //         });
        //     });
        //     this.form.checkList.push({
        //         date: column.date,
        //         works: array,
        //     });
        // });
    },
    props: {
        data: {
            type: Object,
            default: [],
        },
    },
    methods: {
        checkListSubtotal(id) {
            let subtotal = 0;
            this.form.checkList.forEach((checkList) => {
                let workValue = checkList.works.filter((work) => work.id == id);
                subtotal += Number(workValue[0].value);
            });

            return subtotal;
        },
    },
};
</script>
