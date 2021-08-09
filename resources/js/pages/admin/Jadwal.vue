<template>
    <div>
        <Sidebar />
        <Content title="Jadwal">
            <Button @click="showModal=true" class="btn-create" icon="ios-add">Buat Jadwal</Button>
            <div class="px-5 bg-white pb-5">
                <TableJadwal :data="data" />
            </div>
        </Content>
        <ModalJadwal :showModal="showModal" @change="showModal=false" @on-success="getData" />
    </div>
</template>

<script>
import Sidebar from "../../components/admin/Sidebar";
import Content from "../../components/admin/Content";
import TableJadwal from "../../components/admin/TableJadwal";
import ModalJadwal from "../../components/admin/ModalJadwal";

export default {
    data() {
        return {
            showModal: false,
            data: [],
        };
    },
    created() {
        this.getData();
    },
    methods: {
        async getData() {
            var res = await this.callApi("get", "/app/jadwal");
            if (res.status == 200) {
                this.data = res.data;
            }
        },
    },
    components: {
        Sidebar,
        Content,
        TableJadwal,
        ModalJadwal,
    },
};
</script>
