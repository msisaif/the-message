<template>
    <app-layout>
        <div class="bg-white p-4 mt-4">
            <h3 class="text-center text-2xl text-brand-primary font-bold">
                রমজান চেক লিস্ট
            </h3>
            <table class="w-full border border-gray-400 mt-4">
                <tr>
                    <th class="text-left py-1 px-2">কাজের বিবরণ</th>
                    <th
                        v-for="(column, columnIndex) in ramadanCheckListColumns"
                        :key="columnIndex"
                        class="text-center py-1 px-2 border-l border-gray-400"
                    >
                        {{ column.title }}
                    </th>
                    <th
                        class="bg-gray-200 first-letter: text-center py-1 px-2 border-l border-gray-400"
                    >
                        মোট
                    </th>
                </tr>
                <tr
                    v-for="(item, itemIndex) in ramadanCheckListItems"
                    :key="itemIndex"
                >
                    <th class="text-left py-1 px-2 border-t border-gray-400">
                        {{ item.name }}
                    </th>
                    <td
                        v-for="(column, columnIndex) in ramadanCheckListColumns"
                        :key="columnIndex"
                        class="text-center py-1 px-2 border-t border-l border-gray-400"
                    >
                        {{
                            Number(
                                form.ramadanCheckList[columnIndex]["works"][
                                    itemIndex
                                ]["value"]
                            )
                        }}
                        <!-- <input
                            :type="item.type"
                            v-model="
                                form.ramadanCheckList[columnIndex]['works'][
                                    itemIndex
                                ]['value']
                            "
                            :class="{
                                'text-center w-16': item.type == 'number',
                            }"
                        /> -->
                    </td>
                    <th
                        class="text-center py-1 px-2 border-t border-l border-gray-400"
                    >
                        {{ checkListSubtotal(item.id) }}
                    </th>
                </tr>
            </table>
            <div>
                <button>(+) Add New</button>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Select from "@/Components/Select.vue";
import Label from "@/Components/Label.vue";
export default {
    components: {
        AppLayout,
        Link,
        Select,
        Label,
    },
    created() {
        this.ramadanCheckListItems = this.data.ramadanCheckListFields;
        Object.values(this.ramadanCheckListColumns).forEach((column) => {
            let array = [];
            Object.values(this.ramadanCheckListItems).forEach((item) => {
                array.push({
                    id: item.id,
                    value: "",
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
                    date: "23-04-2022",
                    title: "২১ রমজান",
                },
                {
                    date: "24-04-2022",
                    title: "২২ রমজান",
                },
                {
                    date: "25-04-2022",
                    title: "২৩ রমজান",
                },
                {
                    date: "26-04-2022",
                    title: "২৪ রমজান",
                },
                {
                    date: "27-04-2022",
                    title: "২৫ রমজান",
                },
                {
                    date: "28-04-2022",
                    title: "২৬ রমজান",
                },
                {
                    date: "29-04-2022",
                    title: "২৭ রমজান",
                },
                {
                    date: "30-04-2022",
                    title: "২৮ রমজান",
                },
                {
                    date: "01-04-2022",
                    title: "২৯ রমজান",
                },
                {
                    date: "02-04-2022",
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
