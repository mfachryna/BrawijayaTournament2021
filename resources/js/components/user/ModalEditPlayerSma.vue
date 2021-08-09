<template>
    <Modal
        v-model="modalState"
        v-if="data"
        title="Edit Player"
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
                <FormItem v-if="data.gender" prop="gender">
                    <Select v-model="data.gender" placeholder="Jenis Kelamin">
                        <Option value="Laki-Laki">Laki Laki</Option>
                        <Option value="Perempuan">Perempuan</Option>
                    </Select>
                </FormItem>
                <FormItem prop="nim">
                    <Input v-model="data.nim" placeholder="NIM" />
                </FormItem>
                

                <!-- <FormItem prop="angkatan">
                    <Select v-model="data.angkatan" placeholder="Angkatan">
                        <Option v-for="item in angkatan" :value="item" :key="item">{{ item }}</Option>
                    </Select>
                </FormItem>-->
                <FormItem v-if="data.email" prop="email">
                    <Input v-model="data.email" type="email" placeholder="Email" />
                </FormItem>
                <FormItem v-if="data.handphone" prop="handphone">
                    <Input v-model="data.handphone" placeholder="No. Handphone" />
                </FormItem>
                <FormItem v-if="data.nickname" prop="nickname">
                    <Input v-model="data.nickname" placeholder="Nickname" />
                </FormItem>
                <FormItem v-if="data.game_id" prop="game_id">
                    <Input
                        v-model="data.game_id"
                        :placeholder="data.competition_name== 'ml'? 'Server ID': 'ID/Username' "
                    />
                </FormItem>
                <FormItem v-if="data.posisi" prop="posisi">
                    <Select v-model="data.posisi" placeholder="Posisi">
                        <Option value="Kapten">Kapten</Option>
                        <Option value="Player">Player</Option>
                        <Option value="Cadangan">Cadangan</Option>
                    </Select>
                </FormItem>
                <FormItem prop="faculty">
                    <Input type="hidden" v-model="data.faculty" placeholder="Fakultas/Jurusan" :value="tes"/>
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
                        :default-file-list="[{
                            name: 'avatar',
                            url:data.avatar}]"
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
                        :default-file-list="[{
                            name: 'Kartu Tanda Mahasiswa',
                            url:data.ktm}]"
                        :before-upload="handleBeforeUploadKTM"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        :on-success="handleSuccessKTM"
                        :on-remove="handleRemoveKTM"
                    >
                        <div style="padding: 6px 0">
                            <Icon type="ios-cloud-upload" size="25" style="color: #3399ff"></Icon>
                            <p>Upload KTM</p>
                        </div>
                    </Upload>
                </FormItem>
                <FormItem v-if="data.krs" prop="krs">
                    <Upload
                        ref="krs"
                        type="drag"
                        action="/client/upload_krs"
                        :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                        :format="['jpg','jpeg','png']"
                        :default-file-list="[{
                            name: 'Kartu Rencana Studi',
                            url:data.krs}]"
                        :max-size="2048"
                        :before-upload="handleBeforeUploadKRS"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        :on-success="handleSuccessKRS"
                        :on-remove="handleRemoveKRS"
                    >
                        <div style="padding: 6px 0">
                            <Icon type="ios-cloud-upload" size="25" style="color: #3399ff"></Icon>
                            <p>Upload KRS</p>
                        </div>
                    </Upload>
                </FormItem>
            </div>
        </Form>
        <div class="footer" slot="footer">
            <Button
                @click="validateForm"
                :disabled="isSubmit"
                size="small"
                type="primary"
            >Save and Exit</Button>
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
export default {
    props: ["showModal", "teamid", "data"],
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
            isSubmit: false,
            modalState: this.showModal,
            isEmpty: true,
            angkatan: ["2020", "2019", "2018", "2017", "2016", "2015"],

            formRules: {
                nama: [
                    {
                        required: true,
                        message: "Please fill in the Name",
                        trigger: "blur",
                    },
                ],
                gender: [
                    {
                        required: true,
                        message: "Please fill in the Gender",
                        trigger: "blur",
                    },
                ],
                nim: [
                    {
                        required: true,
                        message: "Please fill in the Nim",
                        trigger: "blur",
                    },
                ],
                faculty: [
                    {
                        required: true,
                        message: "Please fill in the Fakultas/Jurusan",
                        trigger: "blur",
                    },
                ],
                angkatan: [
                    {
                        required: true,
                        message: "Please fill in the Angkatan",
                        trigger: "blur",
                    },
                ],
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
                nickname: [
                    {
                        required: true,
                        message: "Please fill in the Nickname",
                        trigger: "blur",
                    },
                ],
                posisi: [
                    {
                        required: true,
                        message: "Please fill in the Server id",
                        trigger: "blur",
                    },
                ],
                game_id: [
                    {
                        required: true,
                        message: "Please fill in the Server id",
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
                krs: [
                    {
                        required: true,
                        message: "Please upload your krs",
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
            },
        };
    },
    methods: {
        async createData() {
            this.isSubmit = true;
            var res = await this.callApi(
                "post",
                `/client/update_player/${this.data.id}`,
                this.data
            );

            if (res.status == 200) {
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
            // if (this.data.avatar != "") {
            //     this.deleteAvatar();
            // }
            // this.data.nama = "";
            // this.data.nim = "";
            // this.data.faculty = "";
            // this.data.angkatan = "";
            // this.data.email = "";
            // this.data.handphone = "";
            // this.data.nickname = "";
            // this.data.game_id = "";
            // this.data.avatar = "";
            // this.data.ktm = "";
            // this.data.krs = "";
            // this.$refs.avatar.clearFiles();
            // this.$refs.ktm.clearFiles();
            // this.$refs.krs.clearFiles();
        },
        cancelSubmit() {
            this.$emit("change", false);
        },
        // Avatar
        async deleteAvatar() {
            var res = await this.callApi("post", "/client/delete_avatar", {
                filename: this.data.avatar,
            });

            if (res.status == 200) {
                this.data.avatar = "";
                this.$refs.avatar.clearFiles();
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
                this.$refs.ktm.clearFiles();
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
                this.deleteKTM();
            }
            return true;
        },

        // KRS
        async deleteKRS() {
            var res = await this.callApi("post", "/client/delete_krs", {
                filename: this.data.krs,
            });

            if (res.status == 200) {
                this.data.krs = "";
                this.$refs.krs.clearFiles();
            }
        },
        handleRemoveKRS(file, fileList) {
            this.deleteKRS();
            this.data.krs = "";
        },
        handleSuccessKRS(res, file) {
            this.data.krs = file.response.url;
        },
        handleBeforeUploadKRS() {
            if (this.$refs.krs.fileList.length) {
                this.deleteKRS();
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
