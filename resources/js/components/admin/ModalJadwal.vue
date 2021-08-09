<template>
    <Modal title="Tambah Jadwal" :closable="false" :maskClosable="false" v-model="modalState">
        <Form ref="form" :model="data" :rules="formRules">
            <FormItem prop="judul">
                <Input
                    v-model="data.judul"
                    maxlength="255"
                    show-word-limit
                    type="textarea"
                    placeholder="Judul"
                    width="100%"
                />
            </FormItem>
            <FormItem prop="lomba">
                <Select v-model="data.lomba" placeholder="Lomba">
                    <Option value="catur">Semua</Option>
                    <Option value="catur">Catur</Option>
                    <Option value="padus">Paduan Suara</Option>
                    <Option value="pubg">PUBG</Option>
                    <Option value="ml">Mobile Legends</Option>
                    <Option value="sinematografi">Sinematografi</Option>
                </Select>
            </FormItem>
            <FormItem prop="tanggal">
                <DatePicker
                    v-model="data.tanggal"
                    type="datetime"
                    placeholder="Pilih Tanggal dan Waktu"
                    style="width: 100%"
                ></DatePicker>
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
                judul: "",
                lomba: "",
                tanggal: "",
            },
            formRules: {
                judul: [
                    {
                        required: true,
                        message: "Please fill the Judul",
                        trigger: "blur",
                    },
                ],
                lomba: [
                    {
                        required: true,
                        message: "Please Select Lomba",
                        trigger: "blur",
                    },
                ],
                tanggal: [
                    {
                        required: true,
                        type: "date",
                        message: "Please fill in the Date",
                        trigger: "blur",
                    },
                ],
            },
        };
    },
    methods: {
        async createData() {
            function twoDigits(d) {
                if (0 <= d && d < 10) return "0" + d.toString();
                if (-10 < d && d < 0) return "-0" + (-1 * d).toString();
                return d.toString();
            }

            Date.prototype.toMysqlFormat = function () {
                return (
                    this.getFullYear() +
                    "-" +
                    twoDigits(1 + this.getMonth()) +
                    "-" +
                    twoDigits(this.getDate()) +
                    " " +
                    twoDigits(this.getHours()) +
                    ":" +
                    twoDigits(this.getMinutes()) +
                    ":" +
                    twoDigits(this.getSeconds())
                );
            };

            var date = this.data.tanggal.toMysqlFormat();

            this.isSubmit = true;
            var res = await this.callApi("post", "/app/jadwal", {
                judul: this.data.judul,
                lomba: this.data.lomba,
                tanggal: date,
            });

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
            this.data.judul = null;
            this.data.lomba = null;
            this.data.tanggal = null;
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
    mounted() {
        this.token = $('meta[name="csrf-token"]').attr("content");
    },
};
</script>
