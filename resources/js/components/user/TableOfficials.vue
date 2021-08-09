<template>
    <div class="card__">
        <h2
            class="d-inline-block"
            style="font-size: 1.5em;font-weight: 600;color: black;margin-top: 4px;margin-bottom: 10px;"
        >Official {{type? title: ''}}</h2>
        <Button
            v-if="data.status == 'draft'"
            :disabled="(type? caturData.length : data.officials.length) == maxOfficial"
            @click="$emit('change')"
            size="small"
            icon="ios-add"
            class="float-right"
        >Tambah Official</Button>
        <table class="table__" width="100%">
            <thead>
                <td style="width:5%">No</td>
                <td style="width:25%">NIM</td>
                <td>Nama</td>
                <td style="width:20%">Handphone</td>
                <td style="width:15%" align="center">Action</td>
            </thead>
            <tbody>
                <tr v-for="(official, i) in (type? caturData : data.officials)" :key="official.id">
                    <td>{{i+1}}</td>
                    <td>{{official.nim}}</td>
                    <td>{{official.nama}}</td>
                    <td>{{official.handphone}}</td>
                    <td align="center">
                        <Button @click="viewOfficial(official.id)" icon="md-eye"></Button>
                        <Button
                            v-if="data.status == 'draft'"
                            @click="editOfficial(official.id)"
                            type="warning"
                            ghost
                            icon="md-create"
                        ></Button>
                        <Button
                            v-if="data.status == 'draft'"
                            @click="deleteOfficial(i, official.id)"
                            type="error"
                            ghost
                            icon="md-trash"
                        ></Button>
                    </td>
                </tr>
                <tr v-if="!data.officials.length">
                    <td colspan="5" align="center">Tidak ada Official, Tambahkan Official</td>
                </tr>
            </tbody>
        </table>
        <ModalEditOfficial
            :showModal="showEditModal"
            :data="official"
            :teamid="data.id"
            @change="(e)=>showEditModal = e"
        />
        <ModalViewPlayer
            :showModal="showViewModal"
            :data="official"
            @change="(e)=>showViewModal = e"
        />
    </div>
</template>

<script>
import ModalEditOfficial from "./ModalEditOfficial";
import ModalViewPlayer from "./ModalViewOfficial";
export default {
    props: [
        "data",
        "maxOfficial",
        "title",
        "type",
        "no_pertandingan",
        "caturData",
    ],
    data() {
        return {
            showEditModal: false,
            showViewModal: false,
            official: null,
        };
    },
    methods: {
        async deleteOfficial(index, id) {
            this.$Modal.confirm({
                title: "Delete Player?",
                content: `<p><strong>${this.data.officials[index].nama}</strong> will be destroy from database</p>`,
                onOk: async () => {
                    var res = await this.callApi(
                        "post",
                        `/client/official/${id}`
                    );
                    if (res.status == 200) {
                        this.$Message.info("Official successfully deleted");
                        this.data.officials.splice(index, 1);
                    } else {
                        this.$Message.error("Something went wrong");
                    }
                },
                onCancel: () => {
                    return;
                },
            });
        },
        async viewOfficial(id) {
            this.official = this.data.officials[
                this.data.officials.findIndex((x) => x.id == id)
            ];
            this.showViewModal = true;
        },
        async editOfficial(id) {
            this.official = this.data.officials[
                this.data.officials.findIndex((x) => x.id == id)
            ];
            this.showEditModal = true;
        },
    },

    components: {
        ModalEditOfficial,
        ModalViewPlayer,
    },
};
</script>
