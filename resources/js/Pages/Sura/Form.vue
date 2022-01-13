<template>
    <div class="w-full max-w-4xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="">
                    <Label value="Sura Number" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.sura_number"
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

                <div class="">
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
                    <Label value="Juz Number" />
                    <Select class="mt-1 block w-full" v-model="form.juz_number">
                        <option value="">- Select -</option>
                        <option
                            v-for="juz in data.juzs"
                            :key="juz.id"
                            :value="juz.juzNumber"
                        >
                            {{ juz.juzNumber }} {{ juz.name }}
                        </option>
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

                <div class="col-span-2 md:col-span-3 col-start-1">
                    <Label value="Arabic" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.arabic"
                    />
                </div>

                <div class="col-span-2 md:col-span-3">
                    <Label value="Pronunciation" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.latin"
                    />
                </div>

                <div class="col-span-2 md:col-span-3">
                    <Label value="Bengali Meaning" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.bengali"
                    />
                </div>

                <div class="col-span-2 md:col-span-3">
                    <Label value="English Meaning" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.english"
                    />
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('suras.index')" />
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
                sura_number: this.data.sura.sura_number,
                juz_number: this.data.sura.juz_number,
                total_ayah: this.data.sura.total_ayah,
                bismillah_pre:
                    this.moduleAction == "store"
                        ? 1
                        : this.data.sura.bismillah_pre,
                revelation_place: this.data.sura.revelation_place,
                revelation_order: this.data.sura.revelation_order,
                arabic: this.data.sura.arabic,
                latin: this.data.sura.latin,
                bengali: this.data.sura.bengali,
                english: this.data.sura.english,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("suras.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("suras.update", this.data.sura.id)
                );
            }
        },
    },
};
</script>
