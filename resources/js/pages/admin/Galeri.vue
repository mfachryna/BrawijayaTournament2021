<template>
    <div>
        <Sidebar />
        <Content title="Galeri">
            <Button @click="createGaleri" class="btn-create" icon="ios-add">Tambah Foto</Button>
            <div v-if="data.length" class="px-5 bg-white pb-5 galeri-container">
                <div v-for="(item, index) in data" :key="item.id" class="card__">
                    <span>
                        <Button @click="deleteItem(index)" icon="ios-trash" ghost type="error"></Button>
                    </span>
                    <img :src="item.url" alt class="img" />
                </div>
            </div>
        </Content>
        <ModalGaleri :showModal="showModal" @change="showModal=false;" @on-success="getData()" />
    </div>
</template>

<style lang="scss" scoped>
.galeri-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(225px, 1fr));
    gap: 8px;

    .card__ {
        position: relative;

        span {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(58, 58, 58);
            opacity: 0;
            transition: all 0.5s;
            cursor: default;
            &:hover {
                opacity: 0.5;
            }
        }

        .img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            background: #b1b1b1;
        }
    }
}
</style>

<script>
import Sidebar from "../../components/admin/Sidebar";
import Content from "../../components/admin/Content";
import ModalGaleri from "../../components/admin/ModalGaleri";

export default {
    data() {
        return {
            data: [],
            showModal: false,
        };
    },

    created() {
        this.getData();
    },
    methods: {
        async getData() {
            var res = await this.callApi("get", "/app/gallery");

            if (res.status == 200) {
                this.data = res.data;
            }
        },

        createGaleri() {
            this.showModal = true;
        },

        deleteItem(index) {
            this.$Modal.confirm({
                title: "Hapus Foto?",
                onOk: async () => {
                    var res = await this.callApi(
                        "post",
                        `/app/gallery/${this.data[index].id}`
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
        ModalGaleri,
    },
};
</script>
