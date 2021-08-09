<template>
    <Modal
        v-model="modalState"
        title="Tambah Official Baru"
        :closable="false"
        :mask-closable="false"
        width="600"
        class-name="vertical-center-modal"
    >
        <Form ref="form" :model="data" :rules="formRules" class="form__">
            <div class="left">
                <FormItem prop="nama">
                    <Input v-model="data.nama" placeholder="Nama" />
                </FormItem>
                <FormItem prop="nim">
                    <Input v-model="data.nim" placeholder="NIM" />
                </FormItem>
                <FormItem v-if="comptt_name == 'catur'" prop="faculty">
                    <Input v-model="data.faculty" placeholder="Fakultas/Jurusan" />
                </FormItem>
                <FormItem v-else>
                    <Input v-model="data.faculty" placeholder="Fakultas/Jurusan" />
                </FormItem>

                <!-- <FormItem v-if="comptt_name == 'catur'" prop="angkatan">
                    <Select v-model="data.angkatan" placeholder="Angkatan">
                        <Option v-for="item in angkatan" :value="item" :key="item">{{ item }}</Option>
                    </Select>
                </FormItem>
                <FormItem v-else>
                    <Select v-model="data.angkatan" placeholder="Angkatan">
                        <Option v-for="item in angkatan" :value="item" :key="item">{{ item }}</Option>
                    </Select>
                </FormItem>-->

                <FormItem prop="university">
                    <Input v-model="data.university" placeholder="Universitas" />
                </FormItem>

                <FormItem prop="email">
                    <Input v-model="data.email" type="email" placeholder="Email" />
                </FormItem>
                <FormItem prop="handphone">
                    <Input v-model="data.handphone" placeholder="No. Handphone/Line" />
                </FormItem>
            </div>
            <div class="right">
                <FormItem prop="avatar">
                    <div v-if="data.avatar != ''">
                        <img class="img_avatar__" :src="data.avatar" />
                    </div>

                    <Upload
                        ref="avatar"
                        action="/client/upload_avatar"
                        :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        :before-upload="handleBeforeUploadAvatar"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        :on-success="handleSuccessAvatar"
                        :on-remove="handleRemoveAvatar"
                    >
                        <Button class="btn-upload" icon="ios-cloud-upload-outline">Upload Foto 3x4</Button>
                    </Upload>
                </FormItem>
                <FormItem prop="ktm">
                    <Upload
                        ref="ktm"
                        type="drag"
                        action="/client/upload_ktm"
                        :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        :before-upload="handleBeforeUploadKTM"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        :on-success="handleSuccessKTM"
                        :on-remove="handleRemoveKTM"
                    >
                        <div style="padding: 6px 0">
                            <Icon type="ios-cloud-upload" size="25" style="color: #3399ff"></Icon>
                            <p>{{comptt_name == 'catur'? 'Upload KTM': 'Upload KTM/KTP'}}</p>
                        </div>
                    </Upload>
                </FormItem>
            </div>
        </Form>
        <div class="footer" slot="footer">
            <Button @click="cancelSubmit" size="small">Cancel</Button>
            <Button @click="validateForm" :disabled="isSubmit" size="small" type="primary">Save</Button>
        </div>
    </Modal>
</template>

<style lang="scss">
.vertical-center-modal {
    display: flex;
    align-items: center;
    justify-content: center;

    .ivu-modal {
        top: 0;
    }
}
.form__ {
    display: flex;
    gap: 8px;
    .left {
        flex: 1;
    }
    .right {
        flex: 0.9;

        .img_avatar__ {
            height: 100px;
            width: 85px;
            object-fit: cover;
            margin: 8px auto;
            border-radius: 4px;
            display: block;
        }

        .ivu-upload-select {
            display: block;

            .btn-upload {
                display: block;
                margin: 0 auto;
            }
        }
    }
}
</style>

<script>
import univ from "../../config/university";
export default {
    props: ["showModal", "teamid", "comptt_name", "no_pertandingan"],
    watch: {
        showModal() {
            this.modalState = this.showModal;
            this.data.team_id = this.teamid;
        },
        data: {
            deep: true,
            handler() {
                this.isEmpty = false;
                this.data.no_pertandingan = this.no_pertandingan;
                if (!this.modalState) {
                    this.isEmpty = true;
                }
            },
        },
    },
    data() {
        return {
            token: "",
            isSubmit: false,
            modalState: this.showModal,
            isEmpty: true,
            angkatan: ["2020", "2019", "2018", "2017", "2016", "2015"],
            universities: univ,
            data: {
                team_id: this.teamid,
                nama: "",
                nim: "",
                faculty: "",
                angkatan: "",
                avatar: "",
                ktm: "",
                university: "",
                email: "",
                handphone: "",
                no_pertandingan: "",
            },
            formRules: {
                nama: [
                    {
                        required: true,
                        message: "Please fill in the Name",
                        trigger: "blur",
                    },
                ],
                // nim: [
                //     {
                //         required: true,
                //         message: "Please fill in the Nim",
                //         trigger: "blur",
                //     },
                // ],
                // faculty: [
                //     {
                //         required: true,
                //         message: "Please fill in the Fakultas/Jurusan",
                //         trigger: "blur",
                //     },
                // ],
                // angkatan: [
                //     {
                //         required: true,
                //         message: "Please fill in the Angkatan",
                //         trigger: "blur",
                //     },
                // ],
                email: [
                    {
                        required: true,
                        message: "Please fill in the Email",
                        trigger: "blur",
                    },
                    {
                        type: "email",
                        message: "Email not valid",
                        trigger: "blur",
                    },
                ],
                handphone: [
                    {
                        required: true,
                        message: "Please fill in the Handphone",
                        trigger: "blur",
                    },
                    {
                        // type: "integer",
                        message: "Phone number is not valid",
                        trigger: "blur",
                    },
                ],
                avatar: [
                    {
                        required: true,
                        message: "Please upload your photo",
                        trigger: "blur",
                    },
                ],
                ktm: [
                    {
                        required: true,
                        message: "Please upload your ktm",
                        trigger: "blur",
                    },
                ],
                // university: [
                //     {
                //         required: true,
                //         message: "Please fill in the University",
                //         trigger: "blur",
                //     },
                // ],
            },
        };
    },
    methods: {
        async createData() {
            this.isSubmit = true;
            var res = await this.callApi("post", "/client/official", this.data);

            if (res.status == 200) {
                this.$emit("on-success");
                this.$emit("change", false);
                this.data.avatar = "";
                this.data.ktm = "";

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
            if (this.data.avatar != "") {
                this.deleteAvatar();
            }

            this.data.nama = "";
            this.data.nim = "";
            this.data.faculty = "";
            this.data.angkatan = "";
            this.data.email = "";
            this.data.handphone = "";
            this.data.avatar = "";
            this.data.ktm = "";
            this.$refs.avatar.clearFiles();
            this.$refs.ktm.clearFiles();
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
        // Avatar
        async deleteAvatar() {
            var res = await this.callApi("post", "/client/delete_avatar", {
                filename: this.data.avatar,
            });

            if (res.status == 200) {
                this.data.avatar = "";
            }
        },
        handleRemoveAvatar(file, fileList) {
            this.deleteAvatar();
            this.data.avatar = "";
        },
        handleSuccessAvatar(res, file) {
            this.data.avatar = file.response.url;
        },
        handleBeforeUploadAvatar() {
            if (this.$refs.avatar.fileList.length) {
                this.$refs.avatar.clearFiles();
                this.deleteAvatar();
            }
            return true;
        },

        // KTM
        async deleteKTM() {
            var res = await this.callApi("post", "/client/delete_ktm", {
                filename: this.data.ktm,
            });

            if (res.status == 200) {
                this.data.ktm = "";
            }
        },
        handleRemoveKTM(file, fileList) {
            this.deleteKTM();
            this.data.ktm = "";
        },
        handleSuccessKTM(res, file) {
            this.data.ktm = file.response.url;
        },
        handleBeforeUploadKTM() {
            if (this.$refs.ktm.fileList.length) {
                this.$refs.ktm.clearFiles();
                this.deleteKTM();
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
