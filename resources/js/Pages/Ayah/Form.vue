<template>
    <div class="w-full max-w-3xl mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-4 gap-x-4">
                <div class="mb-4 md:col-span-2">
                    <Label value="Sura" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.sura_number"
                    >
                        <option value="">- Select -</option>
                        <option
                            v-for="sura in data.suras"
                            :key="sura.id"
                            :value="sura.sura_number"
                        >
                            {{ sura.latin }} - {{ sura.arabic }}
                        </option>
                    </Select>
                </div>
                <div class="mb-4">
                    <Label value="Ayah Number of Quran" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ayah_number"
                        required
                        autofocus
                    />
                </div>
                <div class="mb-4">
                    <Label value="Ayah Number of Sura" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.position"
                        required
                        autofocus
                    />
                </div>
                <div class="mb-4 md:col-span-4">
                    <Label value="Ayah (Arabic)" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.text"
                        required
                        @input="textToWord"
                    />
                </div>
            </div>

            <div
                v-for="(word, index) in words"
                :key="index"
                class="border shadow p-4"
            >
                {{ word }}
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('ayahs.index')" />
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
                ayah_number: this.data.ayah.ayah_number,
                total_ayah: this.data.ayah.total_ayah,
                bismillah_pre:
                    this.moduleAction == "store"
                        ? 1
                        : this.data.ayah.bismillah_pre,
                revelation_place: this.data.ayah.revelation_place,
                revelation_order: this.data.ayah.revelation_order,
                arabic: this.data.ayah.arabic,
                latin: this.data.ayah.latin,
                bengali: this.data.ayah.bengali,
                english: this.data.ayah.english,
            }),
            words: [],
        };
    },

    methods: {
        textToWord(event) {
            this.words = event.target.value.split(" ");
        },
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("ayahs.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("ayahs.update", this.data.ayah.id)
                );
            }
        },
    },
};
</script>
