<template>
    <div style="display:block" class="pengumuman__">
        <h2 class="mb-2">Buat Pengumuman</h2>
        <Form
            ref="form"
            :model="data"
            :rules="rules"
            class="form__"
            label-position="left"
            :label-width="80"
        >
            <FormItem prop="title" class="span-3" label="Title">
                <Input v-model="data.title" placeholder="Title" />
            </FormItem>
            <FormItem prop="type">
                <Select v-model="data.type" placeholder="Jenis Pengumuman">
                    <Option v-for="item in types" :value="item.key" :key="item.key">{{ item.name }}</Option>
                </Select>
            </FormItem>
            <div class="status-form">
                <FormItem prop="status">
                    <RadioGroup v-model="data.status" @on-change="statusPublish">
                        <Radio key="draft" label="draft" border>Draft</Radio>
                        <Radio key="publish" label="publish" border>Publish</Radio>
                    </RadioGroup>
                </FormItem>
                <Button @click="save" class="btn-save md-mr-2" type="primary">Simpan Perubahan</Button>
                <Button class="btn-save" @click="exit">Keluar</Button>
            </div>
        </Form>
        <div class="editorx_body">
            <!--editorjs id-->
            <div class id="codex-editor" />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.pengumuman__ {
    padding: 30px;
    position: relative;

    .form__ {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));

        .btn-save {
            display: block;
            width: 100%;
            margin-bottom: 8px;
        }
    }
}

@media (min-width: 600px) {
    .status-form {
        position: absolute;
        display: flex;
        top: 30px;
        right: 30px;

        .btn-save {
            width: auto !important;
            margin-bottom: 0;
            margin-left: 8px;
        }
    }
    .pengumuman__ {
        .form__ {
            .span-3 {
                grid-column: auto/span 3;
            }
        }
    }
}

.editorx_body {
    border: 1px solid #eeeeee;
    background-color: #fff;
    border-radius: 4px;
    box-sizing: border-box;
    padding: 8px;
}
.ce-block--focused {
    background: linear-gradient(
        90deg,
        rgba(2, 0, 36, 1) 0%,
        rgba(9, 9, 121, 0.5438550420168067) 35%,
        rgba(0, 212, 255, 1) 100%
    );
}
</style>

<script>
import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import Paragraph from "@editorjs/paragraph";
import List from "@editorjs/list";
import ImageTool from "@editorjs/image";
import Embed from "@editorjs/embed";
import Table from "@editorjs/table";

export default {
    data() {
        return {
            token: "",

            types: [
                {
                    key: "ml",
                    name: "Mobile Legends",
                },
                {
                    key: "catur",
                    name: "Catur",
                },
                {
                    key: "padus",
                    name: "Paduan Suara",
                },
                {
                    key: "pubg",
                    name: "PUBG Mobile",
                },
                {
                    key: "sinematografi",
                    name: "Sinematografi",
                },
                {
                    key: "umum",
                    name: "Umum",
                },
            ],
            data: {
                title: "",
                type: "ml",
                status: "",
                content: {},
            },
            rules: {},
        };
    },
    created() {
        this.getData();
    },
    mounted() {
        this.token = $('meta[name="csrf-token"]').attr("content");
    },

    methods: {
        async getData() {
            var res = await this.callApi(
                "get",
                `/app/announcement/${this.$route.params.id}`
            );
            if (res.status == 200 && res.data) {
                this.data = res.data;
                this.data.content = JSON.parse(res.data.content);
                this.myEditor();
            } else {
                this.$router.push("/admin/pengumuman");
            }
        },
        async update(data) {
            var res = await this.callApi(
                "post",
                `/app/update_announcement/${this.data.id}`,
                data
            );
        },
        async save() {
            var content = await editor.save();
            this.update({
                content: JSON.stringify(content),
                title: this.data.title,
                type: this.data.type,
            });
        },
        exit() {
            this.$router.push("/admin/pengumuman");
        },
        myEditor() {
            window.editor = new EditorJS({
                holder: "codex-editor",
                autofocus: true,

                logLevel: "ERROR",
                initialBlock: "paragraph",
                tools: {
                    header: {
                        class: Header,
                        shortcut: "CMD+SHIFT+H",
                        inlineToolbar: true,
                    },
                    embed: {
                        class: Embed,
                        inlineToolbar: true,
                        config: {
                            services: {
                                youtube: true,
                            },
                        },
                    },
                    list: {
                        class: List,
                    },
                    paragraph: {
                        class: Paragraph,
                        config: {
                            placeholder: "Write something",
                        },
                    },
                    image: {
                        class: ImageTool,
                        config: {
                            additionalRequestHeaders: {
                                "X-CSRF-TOKEN": this.token,
                            },
                            endpoints: {
                                byFile: "/app/upload_image", // Your backend file uploader endpoint
                                byUrl: "/app/upload_image_byurl", // Your endpoint that provides uploading by Url
                            },
                        },
                    },
                },
                data: this.data.content,
                onReady: () => {
                    this.save();
                },
                onChange: () => {
                    // this.save();
                },
            });
        },
        statusPublish() {
            if (this.data.status == "publish") {
                this.$Modal.confirm({
                    title: "Publish Pengumuman?",
                    okText: "Publish",
                    cancelText: "Batal",
                    onOk: () => {
                        console.log("its here");
                        this.update({
                            status: "publish",
                            content: JSON.stringify(this.data.content),
                            title: this.data.title,
                            type: this.data.type,
                        });
                    },
                    onCancel: () => {
                        this.data.status = "draft";
                        return;
                    },
                });
            } else {
                this.$Modal.confirm({
                    title: "Draft Pengumuman?",
                    okText: "Draft",
                    cancelText: "Batal",
                    onOk: () => {
                        this.update({
                            status: "draft",
                            posted_on: null,
                        });
                    },
                    onCancel: () => {
                        this.data.status = "publish";
                        return;
                    },
                });
            }
        },
    },
};
</script>
