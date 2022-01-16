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
                <div class="mb-4" v-if="form.sura_number">
                    <Label value="Ayah Number of Sura" />
                    <Select class="mt-1 block w-full" v-model="form.position">
                        <option value="">- Select -</option>
                        <option
                            v-for="n in selectedSura.total_ayah"
                            :key="n"
                            :value="n"
                        >
                            {{ n }}
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

                <div class="mb-4 md:col-span-4">
                    <Label value="Ayah (Arabic)" />
                    <Input
                        dir="rtl"
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

    computed: {
        selectedSura() {
            return [];
            return this.data.suras[
                this.data.suras.findIndex(
                    (item) => item.sura_number == this.form.sura_number
                )
            ];
        },
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
                sura_number: this.data.ayah.sura_number,
                ayah_number: this.data.ayah.ayah_number,
                position: this.data.ayah.position,
                text: this.data.ayah.text,
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
