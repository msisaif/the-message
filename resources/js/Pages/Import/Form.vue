<template>
    <div class="w-full max-w-3xl mx-auto p-4 bg-white border shadow mt-8">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="" enctype="multipart/form-data">
            <input type="file" @input="selectFile" />

            <hr class="w-full my-4" />

            <div class="flex items-center justify-between">
                <Button
                    class=""
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Import
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

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
    },

    data() {
        return {
            form: this.$inertia.form({
                file: "",
            }),
        };
    },

    methods: {
        selectFile(event) {
            // return console.log(event.target.files || event.dataTransfer.files);
            var files = event.target.files || event.dataTransfer.files;
            this.form.file = files[0];
            console.log(313);
        },
        submit() {
            return this.form.post(this.route("collection"));
        },
    },
};
</script>
