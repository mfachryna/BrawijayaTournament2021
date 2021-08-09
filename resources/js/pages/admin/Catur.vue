<template>
    <div>
        <Sidebar />
        <Content title="Catur">
            <Select
                v-model="selectState"
                placement="bottom-end"
                style="width:100px"
                class="btn-create"
            >
                <Option v-for="item in states" :value="item" :key="item">{{ item }}</Option>
            </Select>
            <Button
                :disabled="isFetch"
                @click="getData"
                style="position: absolute;top: -44px;right: 162px;"
            >Refresh</Button>
            <div class="px-5 bg-white pb-5">
                <table class="table__" width="100%">
                    <thead>
                        <td style="width:5%">No</td>
                        <td style>Nama Universitas</td>
                        <td style="width:20%">Status</td>
                    </thead>
                    <tbody v-if="data.length">
                        <tr @click="tableClickHandle(i)" v-for="(item, i) in data" :key="item.id">
                            <td>{{i+1}}</td>
                            <td>{{item.university}}</td>
                            <td>
                                <span
                                    class="text-success"
                                    v-if="item.team_verified_at"
                                >Terverifikasi</span>
                                <span class="text-danger" v-else>Belum Terverifikasi</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </Content>
        <DetailModal
            :teamId="selectedRow"
            maxPlayer="999"
            minPlayer="2"
            minOfficial="0"
            maxOfficial="4"
            :showModal="showModal"
            @change="showModal = false; getData()"
        />
    </div>
</template>

<style lang="scss">
table.table__ {
    thead {
        font-weight: 600;
        td {
            background-color: #f7f7f7;
        }
    }
    td {
        padding: 4px 8px;
    }
    tbody {
        tr {
            cursor: pointer;
            transition: all 0.5s;
            &:hover {
                background-color: #fafafa;
            }
        }
    }
}
</style>

<script>
import Sidebar from "../../components/admin/Sidebar";
import Content from "../../components/admin/Content";
import DetailModal from "../../components/admin/ModalDetailCompetition";

export default {
    data() {
        return {
            isFetch: false,
            showModal: false,
            selectState: "Semua",
            selectedRow: 0,
            states: ["Semua", "Terverifikasi", "Belum Terverfikasi"],
            data: [],
        };
    },
    watch: {
        selectState() {
            this.getData();
        },
    },
    created() {
        this.getData();
    },
    methods: {
        async getData() {
            var url = "/app/competition?type=catur";
            switch (this.selectState) {
                case "Terverifikasi":
                    url += "&verify=1";
                    break;
                case "Belum Terverfikasi":
                    url += "&verify=0";
                    break;
                default:
                    break;
            }
            this.isFetch = true;
            var res = await this.callApi("get", url);
            if (res.status == 200) {
                this.data = res.data;
            }
            this.isFetch = false;
        },
        tableClickHandle(i) {
            this.selectedRow = this.data[i].id;
            this.showModal = true;
        },
    },
    components: {
        Sidebar,
        Content,
        DetailModal,
    },
};
</script>
