<template>
    <div class="w-full max-w-3xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="">
                    <Label value="Sura" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.sura_number"
                        required
                    >
                        <option value="">- Select -</option>
                        <option
                            v-for="sura in data.suras"
                            :key="sura.id"
                            :value="sura.suraNumber"
                        >
                            {{ sura.suraNumber }} -
                            {{ sura.bengaliPronunciation }}
                        </option>
                    </Select>
                </div>
                <div class="">
                    <Label value="Ayah" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ayah"
                        required
                        placeholder="2 অথবা 4-9"
                    />
                </div>
                <div class="col-span-full">
                    <Label value="বিষয়বস্তু" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.topic"
                        required
                    />
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('classifications.index')" />
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
            default: "Save",
        },
        data: {
            type: Object,
            default: {},
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                sura_number: this.data.classification.sura_number,
                ayah: this.data.classification.ayah,
                topic: this.data.classification.topic,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("classifications.store"), {
                    onSuccess: () => {
                        this.form.reset("ayah");
                        this.form.reset("topic");
                    },
                });
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route(
                        "classifications.update",
                        this.data.classification.id
                    )
                );
            }
        },
    },
};
</script>
