<template>
    <app-layout>
        <div class="bg-white p-4 mt-4">
            <h3 class="text-center text-2xl text-brand-primary font-bold my-3">
                রমজান (এতেকাফ) চেক লিস্ট
            </h3>
            <div class="flex justify-center items-center gap-4">
                <Link
                    :href="route('ramadan-checklist.form')"
                    class="border border-brand-primary rounded-md bg-brand-primary text-white flex justify-center items-center px-4 py-1.5 gap-2"
                >
                    <ShieldCheckIcon class="w-6" />
                    <span>এখানে ক্লিক করুন</span>
                </Link>
            </div>
            <div
                v-if="$page.props.auth.user"
                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-6 mt-4"
            >
                <div>
                    Name: <b>{{ $page.props.auth.user.name }}</b>
                </div>
                <div>
                    Email: <b>{{ $page.props.auth.user.email }}</b>
                </div>
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
                            ) in ramadanCheckListColumns"
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
                        v-for="(item, itemIndex) in ramadanCheckListItems"
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
                            ) in ramadanCheckListColumns"
                            :key="columnIndex"
                            class="text-center py-1 px-2 border-t border-l border-gray-300 hidden md:table-cell"
                        >
                            <span v-if="item.type == 'number'">{{
                                form.ramadanCheckList[columnIndex]["works"][
                                    itemIndex
                                ]["value"]
                            }}</span>
                            <span v-if="item.type == 'radio'">
                                <span
                                    v-if="
                                        form.ramadanCheckList[columnIndex][
                                            'works'
                                        ][itemIndex]['value'] === '1'
                                    "
                                >
                                    হ্যাঁ
                                </span>
                                <span
                                    v-if="
                                        form.ramadanCheckList[columnIndex][
                                            'works'
                                        ][itemIndex]['value'] === '0'
                                    "
                                >
                                    না
                                </span>
                            </span>
                        </td>
                        <th
                            class="text-center py-1 px-2 border-t border-l border-gray-300"
                        >
                            {{ checkListSubtotal(item.id) }}
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
import { ShieldCheckIcon } from "@heroicons/vue/outline";
export default {
    components: {
        AppLayout,
        Link,
        ShieldCheckIcon,
        Select,
        Label,
    },
    created() {
        this.ramadanCheckListItems = this.data.ramadanCheckListFields;

        Object.values(this.ramadanCheckListColumns).forEach((column) => {
            let selectedData = Object.values(this.data.userChecklist).filter(
                (list) => {
                    return list.date == column.date;
                }
            )[0];

            let array = [];
            Object.values(this.ramadanCheckListItems).forEach((item) => {
                let selectedDataForSelectedDate;
                if (selectedData) {
                    selectedDataForSelectedDate = Object.values(
                        selectedData.checklist
                    ).filter((check) => {
                        return check.id == item.id;
                    })[0];
                }

                array.push({
                    id: item.id,
                    value: selectedDataForSelectedDate
                        ? selectedDataForSelectedDate.value
                        : "", // current value
                });
            });

            this.form.ramadanCheckList.push({
                date: column.date,
                works: array,
            });
        });
    },
    props: {
        data: {
            type: Object,
            default: [],
        },
    },
    data() {
        return {
            ramadanCheckListItems: [],
            ramadanCheckListColumns: [
                {
                    date: "2022-04-23",
                    title: "২১ রমজান",
                },
                {
                    date: "2022-04-24",
                    title: "২২ রমজান",
                },
                {
                    date: "2022-04-25",
                    title: "২৩ রমজান",
                },
                {
                    date: "2022-04-26",
                    title: "২৪ রমজান",
                },
                {
                    date: "2022-04-27",
                    title: "২৫ রমজান",
                },
                {
                    date: "2022-04-28",
                    title: "২৬ রমজান",
                },
                {
                    date: "2022-04-29",
                    title: "২৭ রমজান",
                },
                {
                    date: "2022-04-30",
                    title: "২৮ রমজান",
                },
                {
                    date: "2022-05-01",
                    title: "২৯ রমজান",
                },
                {
                    date: "2022-05-02",
                    title: "৩০ রমজান",
                },
            ],
            form: {
                ramadanCheckList: [],
            },
        };
    },
    methods: {
        checkListSubtotal(id) {
            let subtotal = 0;
            this.form.ramadanCheckList.forEach((checkList) => {
                let workValue = checkList.works.filter((work) => work.id == id);
                subtotal += Number(workValue[0].value);
            });

            return subtotal;
        },
    },
};
</script>
