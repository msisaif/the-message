<template>
    <div class="w-full max-w-4xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="">
                    <Label value="Course Number" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.course_number"
                        required
                        autofocus
                    />
                </div>

                <div class="">
                    <Label value="Total Ayah" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.total_ayah"
                    />
                </div>

                <div class="">
                    <Label value="Bismillah" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.bismillah_pre"
                    >
                        <option :value="1">Yes</option>
                        <option :value="0">No</option>
                    </Select>
                </div>

                <div class="md:col-span-2">
                    <Label value="Revelation Place" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.revelation_place"
                    >
                        <option value="">- Select -</option>
                        <option :value="1">Makkah</option>
                        <option :value="2">Madinah</option>
                    </Select>
                </div>

                <div class="">
                    <Label value="Revelation Order" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.revelation_order"
                    />
                </div>

                <div class="col-span-2 md:col-span-2 col-start-1">
                    <Label value="Arabic" />
                    <Input
                        dir="rtl"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.arabic"
                    />
                </div>

                <div class="col-span-2 md:col-span-2">
                    <Label value="Bengali Pronunciation" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.bengali_pronunciation"
                    />
                </div>

                <div class="col-span-2 md:col-span-2">
                    <Label value="English Pronunciation" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.english_pronunciation"
                    />
                </div>

                <div class="col-span-2 md:col-span-2">
                    <Label value="Bengali Meaning" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.bengali_meaning"
                    />
                </div>

                <div class="col-span-2 md:col-span-2">
                    <Label value="English Meaning" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.english_meaning"
                    />
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('courses.index')" />
                </div>
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
                course_number: this.data.course.course_number,
                juz_number: this.data.course.juz_number,
                total_ayah: this.data.course.total_ayah,
                bismillah_pre:
                    this.moduleAction == "store"
                        ? 1
                        : this.data.course.bismillah_pre,
                revelation_place: this.data.course.revelation_place,
                revelation_order: this.data.course.revelation_order,
                arabic: this.data.course.arabic,
                bengali_pronunciation: this.data.course.bengali_pronunciation,
                english_pronunciation: this.data.course.english_pronunciation,
                bengali_meaning: this.data.course.bengali_meaning,
                english_meaning: this.data.course.english_meaning,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("courses.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("courses.update", this.data.course.id)
                );
            }
        },
    },
};
</script>
