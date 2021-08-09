<template>
    <div>
        <Sidebar />
        <Content>
            <div class="detail-pengumuman">
                <h1 class="mb-2">{{data.title}}</h1>
                <div v-for="(block, index) in data.content.blocks" :key="index">
                    <h3 v-if="block.type == 'header'" v-html="block.data.text" class="header__"></h3>
                    <p
                        v-else-if="block.type == 'paragraph'"
                        v-html="block.data.text"
                        class="paragraph__"
                    ></p>
                    <img
                        v-else-if="block.type == 'image'"
                        :src="block.data.file.url"
                        class="image__"
                    />
                    <iframe
                        v-else-if="block.type == 'embed'"
                        :src="block.data.embed"
                        frameborder="0"
                        class="embed__"
                    ></iframe>
                    <ul
                        v-else-if="block.type == 'list' && block.data.style == 'unordered'"
                        class="list-ul__"
                    >
                        <li v-for="item in block.data.items" :key="item" v-html="item"></li>
                    </ul>
                    <ol
                        v-else-if="block.type == 'list' && block.data.style == 'ordered'"
                        class="list-ol__"
                    >
                        <li v-for="item in block.data.items" :key="item" v-html="item"></li>
                    </ol>
                </div>
            </div>
        </Content>
    </div>
</template>

<style lang="scss" scoped>
.detail-pengumuman {
    margin: 30px;
    margin-top: -37px;

    .header__ {
        margin: 8px 0;
    }

    .paragraph__ {
        margin: 9px 12px;
    }
    .list-ul__,
    .list-ol__ {
        margin: 8px 49px;
    }
    .image__ {
        width: 80%;
        display: block;
        margin: 19px auto;
    }
    .embed__ {
        width: 80%;
        display: block;
        margin: 18px auto;
        height: 416px;
    }
}
</style>

<script>
import Sidebar from "../../components/user/Sidebar";
import Content from "../../components/user/Content";
export default {
    data() {
        return {
            data: {
                title: "",
                status: "",
                type: "",
                content: {
                    blocks: [],
                },
            },
        };
    },
    created() {
        this.getData();
    },
    methods: {
        async getData() {
            var res = await this.callApi(
                "get",
                `/client/announcement/${this.$route.params.slug}`
            );

            if (res.status == 200 && res.data) {
                this.data = res.data;
                this.data.content = JSON.parse(res.data.content);
            } else {
                this.$router.push("/dashboard/pengumuman");
            }
        },
    },
    components: {
        Sidebar,
        Content,
    },
};
</script>
