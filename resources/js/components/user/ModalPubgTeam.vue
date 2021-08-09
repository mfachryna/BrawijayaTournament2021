<template>
    <Modal
        v-model="modalState"
        title="Daftar Tim PUBG Mobile"
        :closable="false"
        :mask-closable="false"
        width="600"
        class-name="vertical-center-modal"
    >
        <Form ref="form" :model="data" :rules="formRules">
            <FormItem prop="university">
                <Select
                    v-model="data.university"
                    filterable
                    clearable
                    placeholder="Nama Universitas"
                >
                    <Option v-for="univ in listUniv" :key="univ" :value="univ">{{univ}}</Option>
                </Select>
            </FormItem>
            <FormItem prop="team_name">
                <Input v-model="data.team_name" placeholder="Nama Tim" width="100%" />
            </FormItem>
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
</style>

<script>
import univ from "../../config/university";

export default {
    props: ["showModal", "teamid"],
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
            listUniv: univ,
            data: {
                team_name: "",
                university: "",
                type: "pubg",
            },
            formRules: {
                team_name: [
                    {
                        required: true,
                        message: "Please fill in the Team Name",
                        trigger: "blur",
                    },
                ],
                university: [
                    {
                        required: true,
                        message: "Please fill in the University Name",
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
                "/client/competition",
                this.data
            );

            if (res.status == 200) {
                this.$emit("on-success");
                this.$emit("change", false);
                this.resetForm();
                this.$router.push("/dashboard/pubg");
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
            this.data.university = "";
            this.data.team_name = "";
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
    },
};
</script>
