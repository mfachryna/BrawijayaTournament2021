<template>
    <div>
        <Sidebar />
        <Content title="Berita">
            <Button @click="createPengumuman" class="btn-create" icon="ios-add">Buat Berita</Button>
            <div class="px-5 bg-white pb-5">
                <table class="table__" width="100%">
                    <thead>
                        <td style="width:5%">No</td>
                        <td>Title</td>
                        <td>Type</td>
                        <td>Status</td>
                        <td align="center" style="width:15%">Action</td>
                    </thead>
                    <tbody v-if="data.length">
                        <tr v-for="(item, i) in data" :key="item.id">
                            <td>{{i+1}}</td>
                            <td @click="tableClickHandle(i)">{{item.title}}</td>
                            <td>{{item.type}}</td>
                            <td>{{item.status}}</td>
                            <td align="center">
                                <!-- <Button icon="md-eye" size="small" type="primary" ghost></Button> -->
                                <Button
                                    @click="tableClickHandle(i)"
                                    icon="md-create"
                                    size="small"
                                    type="warning"
                                    ghost
                                ></Button>
                                <Button
                                    @click="deleteItem(i)"
                                    icon="ios-trash"
                                    size="small"
                                    type="error"
                                    ghost
                                ></Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </Content>
    </div>
</template>

<script>
import Sidebar from "../../components/admin/Sidebar";
import Content from "../../components/admin/Content";

export default {
    data() {
        return {
            data: [],
        };
    },

    created() {
        this.getData();
    },
    methods: {
        async getData() {
            var res = await this.callApi("get", "/app/news");

            if (res.status == 200) {
                this.data = res.data;
            }
        },

        async createPengumuman() {
            var res = await this.callApi("post", "/app/news", {
                title: `berita-${this.data.length + 1}`,
            });

            if (res.status == 201) {
                this.$router.push({
                    name: "createBerita",
                    params: { id: res.data.id },
                });
            }
        },
        tableClickHandle(i) {
            this.$router.push({
                name: "createBerita",
                params: { id: this.data[i].id },
            });
        },
        deleteItem(index) {
            this.$Modal.confirm({
                title: "Hapus Berita?",
                onOk: async () => {
                    var res = await this.callApi(
                        "delete",
                        `/app/news/${this.data[index].id}`
                    );

                    if (res.status == 200) {
                        this.$Message.info("Delete successfully!");
                        this.data.splice(index, 1);
                    }
                },
                onCancel: () => {
                    return;
                },
            });
        },
    },
    components: {
        Sidebar,
        Content,
    },
};
</script>
