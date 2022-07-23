<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="col-span-2 col-start-1">
                    <Label value="Title" />
                    <Input
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                    />
                </div>
                <div class="col-span-2 col-start-1">
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.type"
                        required
                    >
                        <option value="">-- Select Type --</option>
                        <option v-for="(typeLabel, typeValue) in data.types" :key="typeValue" :value="typeValue">
                            {{ typeLabel }}
                        </option>
                    </Select>
                </div>
            </div>

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <div class="">
                    <go-to-list :href="route('playlists.index')" />
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
                title: this.data.playlist.title,
                type: this.data.playlist.type,
            }),
        };
    },

    methods: {
        submit() {
            if (this.moduleAction == "store") {
                return this.form.post(this.route("playlists.store"));
            }

            if (this.moduleAction == "update") {
                return this.form.put(
                    this.route("playlists.update", this.data.playlist.id)
                );
            }
        },
    },
};
</script>
