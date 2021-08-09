<template>
    <Modal
        v-model="modalState"
        title="Tambah Player Baru"
        :closable="false"
        :mask-closable="false"
        width="600"
    >
        <Form ref="form" :model="data" :rules="formRules" class="form__">
            <div class="left">
                <FormItem prop="nama">
                    <Input v-model="data.nama" placeholder="Nama" />
                </FormItem>
                <FormItem v-if="comptt_name !='mlsma'" prop="gender">
                    <Select v-model="data.gender" placeholder="Jenis Kelamin">
                        <Option value="Laki-Laki">Laki Laki</Option>
                        <Option value="Perempuan">Perempuan</Option>
                    </Select>
                </FormItem>
                <FormItem prop="nim">
                    <Input v-model="data.nim" placeholder="NIS" />
                </FormItem>

                <!-- <FormItem prop="angkatan">
                    <Select v-model="data.angkatan" placeholder="Angkatan">
                        <Option v-for="item in angkatan" :value="item" :key="item">{{ item }}</Option>
                    </Select>
                </FormItem>-->
                <FormItem v-if="comptt_name == 'mlsma'" prop="email">
                    <Input v-model="data.email" type="email" placeholder="Email" />
                </FormItem>
                <FormItem v-if="comptt_name == 'mlsma' || comptt_name == 'pubg'|| comptt_name == 'valorant'" prop="handphone">
                    <Input v-model="data.handphone" placeholder="No. Handphone/Line" />
                </FormItem>
                <FormItem v-if="comptt_name == 'mlsma' " prop="nickname">
                    <Input v-model="data.nickname" placeholder="Nickname" />
                </FormItem>
                <FormItem v-if="comptt_name == 'mlsma' || comptt_name == 'pubgsma' || comptt_name == 'valorantsma'" prop="game_id">
                    <Input
                        v-model="data.game_id"
                        :placeholder="comptt_name== 'mlsma'? 'Server ID': 'ID/Username' "
                    />
                </FormItem>
                <FormItem v-if="comptt_name == 'mlsma' || comptt_name == 'pubgsma' || comptt_name == 'valorantsma'" prop="posisi">
                    <Select v-model="data.posisi" placeholder="Posisi">
                        <Option value="Kapten">Kapten</Option>
                        <Option value="Player">Player</Option>
                        <Option value="Cadangan">Cadangan</Option>
                    </Select>
                </FormItem>
                <FormItem prop="faculty">
                    <Input type="hidden" placeholder="Fakultas/Jurusan" value="tes"/>
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
                            <p>Upload KTM</p>
                        </div>
                    </Upload>
                </FormItem>
                <FormItem prop="krs">
                    <Upload
                        ref="krs"
                        type="drag"
                        action="/client/upload_krs"
                        :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                        :format="['jpg','jpeg','png']"
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
            data: {
                team_id: this.teamid,
                competition_name: this.comptt_name,
                nama: "",
                nim: "",
                faculty: "no",
                angkatan: "",
                avatar: "",
                ktm: "",
                krs: "",
                email: "",
                handphone: "",
                nickname: "",
                game_id: "",
                posisi: "",
                gender: "",
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
                        message: "Please fill in the Nis",
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
                posisi: [
                    {
                        required: true,
                        message: "Please fill in the Server id",
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
            var res = await this.callApi("post", "/client/player", this.data);

            if (res.status == 200) {
                this.$emit("on-success");
                this.$emit("change", false);
                this.data.avatar = "";
                this.data.ktm = "";
                this.data.krs = "";
                this.resetForm();
            } else {
                this.$Message.error("Something Went Wrong");
                if (res.status == 420) {
                    this.$Notice.warning({
                        title: "Pendaftaran Gagal",
                        desc: res.data.errors,
                    });
                } else {
                    this.$Notice.warning({
                        title: "Pendaftaran Gagal",
                        desc: "Periksa Kembali Formulir Anda",
                    });
                }
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
            this.data.gender = "";
            this.data.nim = "";
            this.data.faculty = "no";
            this.data.angkatan = "";
            this.data.email = "";
            this.data.handphone = "";
            this.data.nickname = "";
            this.data.game_id = "";
            this.data.avatar = "";
            this.data.posisi = "";
            this.data.ktm = "";
            this.data.krs = "";
            // this.data.no_pertandingan = "",
            this.$refs.avatar.clearFiles();
            this.$refs.ktm.clearFiles();
            this.$refs.krs.clearFiles();
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

        // KRS
        async deleteKRS() {
            var res = await this.callApi("post", "/client/delete_krs", {
                filename: this.data.krs,
            });

            if (res.status == 200) {
                this.data.krs = "";
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
                this.$refs.krs.clearFiles();
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
