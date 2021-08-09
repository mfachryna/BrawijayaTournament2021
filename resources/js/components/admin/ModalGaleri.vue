<template>
    <Modal title="Tambah Galeri" :closable="false" :maskClosable="false" v-model="modalState">
        <Form ref="form" :model="data" :rules="formRules">
            <FormItem prop="title">
                <Input v-model="data.title" placeholder="Title" width="100%" />
            </FormItem>
            <FormItem prop="lokasi">
                <Select v-model="data.lokasi" placeholder="Posisi Foto">
                    <Option value="home">Landing Page</Option>
                    <Option value="gallery">Gallery Page</Option>
                </Select>
            </FormItem>

            <img :src="data.url" alt srcset style="width: 100%;margin: 8px 0;" />
            <FormItem prop="url">
                <Upload
                    ref="image"
                    name="image"
                    type="drag"
                    action="/app/upload_image"
                    :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                    :format="['jpg','jpeg','png']"
                    :max-size="2048"
                    :before-upload="handleBeforeUpload"
                    :on-format-error="handleFormatError"
                    :on-exceeded-size="handleMaxSize"
                    :on-success="handleSuccess"
                    :on-remove="handleRemove"
                >
                    <div style="padding: 6px 0">
                        <Icon type="ios-cloud-upload" size="25" style="color: #3399ff"></Icon>
                        <p>Upload Image</p>
                    </div>
                </Upload>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button @click="cancelSubmit">Cancel</Button>
            <Button @click="validateForm" type="primary">Save</Button>
        </div>
    </Modal>
</template>

<script>
export default {
    props: ["showModal"],
    watch: {
        showModal() {
            this.modalState = this.showModal;
        },
        data: {
            deep: true,
            handler() {
                this.isEmpty = false;
                if (!this.modalState) {
                    this.isEmpty = true;
                }
            },
        },
    },
    data() {
        return {
            token: "",
            modalState: this.showModal,
            isEmpty: true,
            isSubmit: false,
            data: {
                title: "",
                url: "",
                lokasi: "",
            },
            formRules: {
                title: [
                    {
                        required: true,
                        message: "Please fill the title",
                        trigger: "blur",
                    },
                ],
                url: [
                    {
                        required: true,
                        message: "Please upload Image",
                        trigger: "blur",
                    },
                ],
                lokasi: [
                    {
                        required: true,
                        message: "Please upload Image",
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    methods: {
        async createData() {
            this.isSubmit = true;
            var res = await this.callApi("post", "/app/gallery", this.data);

            if (res.status == 201) {
                this.$emit("on-success");
                this.$emit("change", false);
                this.resetForm();
            } else {
                this.$Message.error("Something Went Wrong");
            }
            this.isSubmit = false;
        },
        validateForm() {
            this.$refs["form"].validate((valid) => {
                if (valid) {
                    this.createData();
                } else {
                    this.$Message.error("Form is empty");
                }
            });
        },
        resetForm() {
            this.data.title = "";
            this.data.url = "";
            this.$refs.image.clearFiles();
        },
        cancelSubmit() {
            if (!this.isEmpty) {
                this.$Modal.confirm({
                    title: "Close Modal?",
                    content: "<p>All data in form will be destroy</p>",
                    onOk: () => {
                        this.$emit("change", false);
                        this.resetForm();
                    },
                    onCancel: () => {
                        return;
                    },
                });
                return;
            }
            this.$emit("change", false);
            this.resetForm();
        },
        async deleteImage() {
            var res = await this.callApi("post", "/app/delete_image", {
                filename: this.data.url,
            });

            if (res.status == 200) {
                this.data.url = "";
                this.$refs.image.clearFiles();
            }
        },
        handleRemove(file, fileList) {
            this.deleteImage();
            this.data.url = "";
        },
        handleSuccess(res, file) {
            this.data.url = file.response.file.url;
        },
        handleBeforeUpload() {
            if (this.$refs.image.fileList.length) {
                this.$refs.image.clearFiles();
                this.deleteImage();
            }
            return true;
        },
        handleFormatError(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select jpg or png.",
            });
        },
        handleMaxSize(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },
    },
    mounted() {
        this.token = $('meta[name="csrf-token"]').attr("content");
    },
};
</script>
