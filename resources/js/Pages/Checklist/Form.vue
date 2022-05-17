<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="mb-6">
                <Select
                    class="mt-1 block w-full"
                    v-model="form.date"
                    @change="selectDateHandler"
                    required
                >
                    <option
                        v-for="(column, index) in data.checkListColumns"
                        :key="index"
                        :value="column.value"
                    >
                        {{ column.title }}
                    </option>
                </Select>
            </div>
            <div class="grid gap-6">
                <div
                    v-for="(checkList, index) in data.ramadanCheckListFields"
                    :key="index"
                    class="flex justify-between items-center gap-4"
                >
                    <div class="grow shrink text-left">
                        {{ checkList.name }}
                    </div>
                    <div
                        v-if="checkList.type == 'radio'"
                        class="grow-0 shrink-0 flex justify-center items-center min-w-max gap-4"
                    >
                        <div class="flex gap-2 justify-center items-center">
                            <Input
                                :type="checkList.type"
                                v-model="form.checklist[index]['value']"
                                class="cursor-pointer"
                                :name="`checklist${index}`"
                                :checked="
                                    form.checklist[index]['value'] === '1'
                                "
                                :value="1"
                            />
                            <Label value="হ্যাঁ" class="text-base"></Label>
                        </div>
                        <div class="flex gap-2 justify-center items-center">
                            <Input
                                :type="checkList.type"
                                v-model="form.checklist[index]['value']"
                                class="cursor-pointer"
                                :name="`checklist${index}`"
                                :checked="
                                    form.checklist[index]['value'] === '0'
                                "
                                :value="0"
                            />
                            <Label value="না" class="text-base"></Label>
                        </div>
                    </div>
                    <div
                        v-if="checkList.type == 'number'"
                        class="grow-0 shrink-0 flex justify-center items-center min-w-max gap-4"
                    >
                        <div class="flex gap-2 justify-center items-center">
                            <Input
                                :type="checkList.type"
                                v-model="form.checklist[index]['value']"
                                class="w-24 text-center py-1"
                                placeholder="সংখ্যা"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-end">
                <Button
                    class=""
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ buttonValue }}
                </Button>
            </div>
        </form>
    </div>
</template>

<script>
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import GoToList from "@/Components/GoToList.vue";
import Select from "@/Components/Select.vue";

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
        GoToList,
        Select,
    },

    created() {
        this.form.date = this.data.selectedDate;

        Object.values(this.data.ramadanCheckListFields).forEach((checkList) => {
            let selectedColumn = Object.values(
                this.data.selectedRamadanChecklist
            ).filter((selectedChecklist) => {
                return selectedChecklist.id == checkList.id;
            })[0];

            this.form.checklist.push({
                id: checkList.id,
                value: selectedColumn ? selectedColumn.value : "",
            });
        });
        console.log(this.form);
    },

    props: {
        moduleAction: String,
        buttonValue: {
            type: String,
            default: "Submit",
        },
        data: {
            type: Object,
            default: {},
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                date: "",
                checklist: [],
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("checklist.save"));
            }
        },
        selectDateHandler(event) {
            return (window.location.href = this.route(
                "checklist.form",
                event.target.value
            ));
        },
    },
};
</script>
