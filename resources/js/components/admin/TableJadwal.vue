<template>
    <table width="100%">
        <thead>
            <td style="width:46%" align="center">Judul</td>
            <td style="width:20%" align="center">Lomba</td>
            <td align="center">Tanggal</td>
            <td style="width:10%" align="center">Action</td>
        </thead>
        <tbody>
            <tr v-for="(item, i) in data" :key="item.id" :id="item.id" class="item">
                <td>{{item.judul}}</td>
                <td align="center">
                    <span v-if="item.lomba == 'catur'">Catur</span>
                    <span v-else-if="item.lomba == 'padus'">Paduan Suara</span>
                    <span v-else-if="item.lomba == 'pubg'">PUBG</span>
                    <span v-else-if="item.lomba == 'ml'">Mobile Legends</span>
                    <span v-else-if="item.lomba == 'sinematografi'">Sinematografi</span>
                    <span v-else>Semua Lomba</span>
                </td>
                <td align="center">{{getTime(item.tanggal)}}</td>

                <td align="center">
                    <Button type="error" ghost @click="deleteItem(i)" icon="md-trash"></Button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style lang="scss" scoped>
thead {
    td {
        padding: 4px;
        box-sizing: border-box;
        background-color: #b4b4b4;
        color: white;
        font-size: 1.1em;
    }
}
tbody {
    tr {
        transition: all 0.5s;
        &:hover {
            background-color: #f7f7f7;
        }
        td {
            padding: 8px;
        }
    }
}
</style>

<script>
import moment from "moment";

export default {
    props: ["data"],

    methods: {
        deleteItem(index) {
            this.$Modal.confirm({
                title: "Hapus Jadwal?",
                onOk: async () => {
                    var res = await this.callApi(
                        "post",
                        `/app/jadwal/${this.data[index].id}`
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

        getTime(time) {
            var date = new Date(time);

            // return (
            //     date.toDateString() +
            //     " " +
            //     date.getHours() +
            //     ":" +
            //     date.getMinutes()
            // );
            return time;
        },
    },
};
</script>
