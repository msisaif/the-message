<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <Label value="Juz Number" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.juz_number"
                        required
                    />
                </div>
                <div>
                    <Label value="Total Ayah" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.total_ayah"
                        required
                    />
                </div>
                <div>
                    <Label value="First Ayah" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.first_ayah"
                        required
                    />
                </div>
                <div>
                    <Label value="Last Ayah" />
                    <Input
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.last_ayah"
                        required
                    />
                </div>
                <div class="col-span-2 col-start-1">
                    <Label value="Juz Name" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
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
