<template>
    <div>
        <Sidebar />
        <Content title="Pengumuman">
            <div class="pengumuman-container pb-5" v-if="data.length">
                <div class="card__" v-for="item in data" :key="item.id">
                    <h2
                        @click="$router.push({name:'userDetailPengumuman',params:{slug:item.slug}})"
                    >{{item.title}}</h2>
                    <p>
                        <span v-if="item.type =='catur'">Catur</span>
                        <span v-else-if="item.type =='padus'">Paduan Suara</span>
                        <span v-else-if="item.type =='pubg'">PUBG Mobile</span>
                        <span v-else-if="item.type =='ml'">Mobile Legends</span>
                        <span v-else-if="item.type =='sinematografi'">Sinematografi</span>
                        <span v-else>Untuk Umum</span>
                    </p>
                    <p>Posted on {{item.posted_on.split(' ')[0]}}</p>
                    <p class="content-card__" v-if="item.content">
                        <span
                            v-for="(text, index) in  JSON.parse(item.content).blocks"
                            :key="index"
                            v-html="text.type == 'paragraph'? text.data.text : ''"
                        ></span>
                    </p>
                </div>
            </div>
        </Content>
    </div>
</template>

<style lang="scss" scoped>
.pengumuman-container {
    display: grid;
    padding: 0 50px;
    box-sizing: border-box;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 18px;
    .card__ {
        background-color: #fff;
        padding: 30px;
        box-sizing: border-box;
        h2 {
            font-size: 1.5em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* number of lines to show */
            -webkit-box-orient: vertical;
            cursor: pointer;
            transition: all 0.5s;

            &:hover {
                text-decoration-line: underline;
                color: black;
            }
        }
        p {
            color: #b1b1b1;

            &.content-card__ {
                margin-top: 18px;
                color: #515a6e;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 5; /* number of lines to show */
                -webkit-box-orient: vertical;
            }
        }
    }
}
</style>

<script>
import Sidebar from "../../components/user/Sidebar";
import Content from "../../components/user/Content";
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
            var res = await this.callApi(
                "get",
                "/client/announcement?status=1"
            );
            if (res.status == 200) {
                this.data = res.data;
            }
        },
    },

    components: {
        Sidebar,
        Content,
    },
};
</script>
