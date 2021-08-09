<template>
    <Modal
        v-model="modalState"
        v-if="data"
        title="View Data"
        :closable="false"
        :mask-closable="false"
        width="600"
        class-name="vertical-center-modal"
    >
        <Form
            ref="form"
            :model="data"
            :rules="formRules"
            class="form__"
            label-position="left"
            :label-width="120"
        >
            <div class="left">
                <FormItem prop="nama" label="Nama">
                    <Input disabled v-model="data.nama" placeholder="Nama" />
                </FormItem>
                <FormItem v-if="data.gender" prop="gender" label="Jenis Kelamin">
                    <Select disabled v-model="data.gender" placeholder="Jenis Kelamin">
                        <Option value="Laki-Laki">Laki Laki</Option>
                        <Option value="Perempuan">Perempuan</Option>
                    </Select>
                </FormItem>
                <FormItem prop="nim" label="NIM">
                    <Input disabled v-model="data.nim" placeholder="NIM" />
                </FormItem>
                <FormItem v-if="data.faculty" prop="faculty" label="Fakultas/Jurusan">
                    <Input disabled v-model="data.faculty" placeholder="Fakultas/Jurusan" />
                </FormItem>
                <FormItem v-if="data.university" prop="university" label="Universitas">
                    <Input disabled v-model="data.university" placeholder="Universitas" />
                </FormItem>
                <!-- <FormItem v-if="data.angkatan" prop="angkatan" label="Angkatan">
                    <Select disabled v-model="data.angkatan" placeholder="Angkatan">
                        <Option v-for="item in angkatan" :value="item" :key="item">{{ item }}</Option>
                    </Select>
                </FormItem>-->
                <FormItem v-if="data.email" prop="email" label="Email">
                    <Input disabled v-model="data.email" type="email" placeholder="Email" />
                </FormItem>
                <FormItem v-if="data.handphone" prop="handphone" label="No. Handphone/Line">
                    <Input disabled v-model="data.handphone" placeholder="No. Handphone/Line" />
                </FormItem>
                <FormItem v-if="data.nickname" prop="nickname" label="Nickname">
                    <Input disabled v-model="data.nickname" placeholder="Nickname" />
                </FormItem>
                <FormItem
                    v-if="data.game_id"
                    prop="game_id"
                    :label="data.competition_name== 'ml'? 'Server ID': 'ID/Username' "
                >
                    <Input
                        disabled
                        v-model="data.game_id"
                        :placeholder="data.competition_name== 'ml'? 'Server ID': 'ID/Username' "
                    />
                </FormItem>
                <FormItem v-if="data.posisi" prop="posisi" label="Posisi">
                    <Input disabled v-model="data.posisi" placeholder="Posisi" />
                </FormItem>
            </div>
            <div class="right">
                <FormItem prop="avatar">
                    <div v-if="data.avatar != ''">
                        <img class="img_avatar__" :src="data.avatar" />
                    </div>
                </FormItem>
                <FormItem prop="ktm">
                    <p style="text-align: center;">
                        File KTM
                        <a :href="data.ktm" target="_blank">(download)</a>
                    </p>
                </FormItem>
                <FormItem v-if="data.krs" prop="krs">
                    <p style="text-align: center;">
                        File KRS
                        <a :href="data.krs" target="_blank">(download)</a>
                    </p>
                </FormItem>
            </div>
        </Form>
        <div class="footer" slot="footer">
            <Button @click="cancelSubmit" size="small" type="primary">Exit</Button>
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
    props: ["showModal", "data"],
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
            universities: univ,
            formRules: {},
        };
    },
    methods: {
        cancelSubmit() {
            this.$emit("change", false);
        },
        // Avatar
    },
    mounted() {
        this.token = $('meta[name="csrf-token"]').attr("content");
    },
};
</script>
