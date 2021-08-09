<template>
    <div>
        <Sidebar />
        <Content title="Cabang Lomba">
            <div class="container_lomba">
                <div class="card__">
                    <img class="thumbnail__" src="../../../assets/pubg.png" alt srcset />
                    <h4>PUBG UNIV</h4>
                    <div class="content__">
                        <div
                            v-if="data.pubg"
                            style="display: flex;flex-direction: column;padding: 8px;box-sizing: border-box;"
                        >
                            <p
                                v-if="data.pubg.status == 'draft'"
                            >Telah Mendaftar dan Formulir belum dikirim</p>
                            <p
                                v-else-if="data.pubg.status == 'sended' && data.pubg.team_verified_at"
                            >Formulir Terverifikasi</p>
                            <p v-else>Formulir telah dikirim</p>
                            <div
                                class="mt-2 d-flex align-items-center"
                                style="justify-content: space-evenly;"
                            >
                                <Button
                                    @click="$router.push('/dashboard/pubg')"
                                    style="display: block;width: 85%;"
                                >Lihat Formulir</Button>
                                <Button
                                    v-if="data.pubg.status == 'draft'"
                                    @click="deleteCompetition(data.pubg.id)"
                                    icon="ios-trash"
                                    type="error"
                                    ghost
                                ></Button>
                            </div>
                        </div>
                        <Button v-else @click="showPubgTeam=true">Daftar Sekarang</Button>
                    </div>
                </div>
                 <div class="card__">
                    <img class="thumbnail__" src="../../../assets/pubg.png" alt srcset />
                    <h4>PUBG SMA</h4>
                    <div class="content__">
                        <div
                            v-if="data.pubgsma"
                            style="display: flex;flex-direction: column;padding: 8px;box-sizing: border-box;"
                        >
                            <p
                                v-if="data.pubgsma.status == 'draft'"
                            >Telah Mendaftar dan Formulir belum dikirim</p>
                            <p
                                v-else-if="data.pubgsma.status == 'sended' && data.pubgsma.team_verified_at"
                            >Formulir Terverifikasi</p>
                            <p v-else>Formulir telah dikirim</p>
                            <div
                                class="mt-2 d-flex align-items-center"
                                style="justify-content: space-evenly;"
                            >
                                <Button
                                    @click="$router.push('/dashboard/pubgsma')"
                                    style="display: block;width: 85%;"
                                >Lihat Formulir</Button>
                                <Button
                                    v-if="data.pubgsma.status == 'draft'"
                                    @click="deleteCompetition(data.pubgsma.id)"
                                    icon="ios-trash"
                                    type="error"
                                    ghost
                                ></Button>
                            </div>
                        </div>
                        <Button v-else @click="showPubgSmaTeam=true">Daftar Sekarang</Button>
                    </div>
                </div>
                 <div class="card__">
                    <img
                        class="thumbnail__"
                        src="../../../assets/ml.png"
                        alt
                        srcset
                        style="transform: translateY(-15px);"
                    />
                    <h4>Mobile Legends</h4>
                    <div class="content__">
                        <div
                            v-if="data.ml"
                            style="display: flex;flex-direction: column;padding: 8px;box-sizing: border-box;"
                        >
                            <p
                                v-if="data.ml.status == 'draft'"
                            >Telah Mendaftar dan Formulir belum dikirim</p>
                            <p
                                v-else-if="data.ml.status == 'sended' && data.ml.team_verified_at"
                            >Formulir Terverifikasi</p>
                            <p v-else>Formulir telah dikirim</p>
                            <div
                                class="mt-2 d-flex align-items-center"
                                style="justify-content: space-evenly;"
                            >
                                <Button
                                    @click="$router.push('/dashboard/mobile-legends')"
                                    style="display: block;width: 85%;"
                                >Lihat Formulir</Button>
                                <Button
                                    @click="deleteCompetition(data.ml.id)"
                                    v-if="data.ml.status == 'draft'"
                                    icon="ios-trash"
                                    type="error"
                                    ghost
                                ></Button>
                            </div>
                        </div>
                        <Button v-else @click="showMlTeam=true">Daftar Sekarang</Button>
                    </div>
                </div>
                
                <div class="card__">
                    <img
                        class="thumbnail__"
                        src="../../../assets/ml.png"
                        alt
                        srcset
                        style="transform: translateY(-15px);"
                    />
                    <h4>Mobile Legends SMA</h4>
                    <div class="content__">
                        <div
                            v-if="data.mlsma"
                            style="display: flex;flex-direction: column;padding: 8px;box-sizing: border-box;"
                        >
                            <p
                                v-if="data.mlsma.status == 'draft'"
                            >Telah Mendaftar dan Formulir belum dikirim</p>
                            <p
                                v-else-if="data.mlsma.status == 'sended' && data.mlsma.team_verified_at"
                            >Formulir Terverifikasi</p>
                            <p v-else>Formulir telah dikirim</p>
                            <div
                                class="mt-2 d-flex align-items-center"
                                style="justify-content: space-evenly;"
                            >
                                <Button
                                    @click="$router.push('/dashboard/mobile-legends-sma')"
                                    style="display: block;width: 85%;"
                                >Lihat Formulir</Button>
                                <Button
                                    @click="deleteCompetition(data.mlsma.id)"
                                    v-if="data.mlsma.status == 'draft'"
                                    icon="ios-trash"
                                    type="error"
                                    ghost
                                ></Button>
                            </div>
                        </div>
                        <Button v-else @click="showMlSmaTeam=true">Daftar Sekarang</Button>
                    </div>
                </div>
                <div class="card__">
                    <img class="thumbnail__" src="../../../assets/valorant.png" alt srcset />
                    <h4>Valorant</h4>
                    <div class="content__">
                        <div
                            v-if="data.valorant"
                            style="display: flex;flex-direction: column;padding: 8px;box-sizing: border-box;"
                        >
                            <p
                                v-if="data.valorant.status == 'draft'"
                            >Telah Mendaftar dan Formulir belum dikirim</p>
                            <p
                                v-else-if="data.valorant.status == 'sended' && data.valorant.team_verified_at"
                            >Formulir Terverifikasi</p>
                            <p v-else>Formulir telah dikirim</p>
                            <div
                                class="mt-2 d-flex align-items-center"
                                style="justify-content: space-evenly;"
                            >
                                <Button
                                    @click="$router.push('/dashboard/valorant')"
                                    style="display: block;width: 85%;"
                                >Lihat Formulir</Button>
                                <Button
                                    v-if="data.valorant.status == 'draft'"
                                    @click="deleteCompetition(data.valorant.id)"
                                    icon="ios-trash"
                                    type="error"
                                    ghost
                                ></Button>
                            </div>
                        </div>
                        <Button v-else @click="showValorantTeam=true">Daftar Sekarang</Button>
                    </div>
                </div>
                
                <div class="card__">
                    <img class="thumbnail__" src="../../../assets/valorant.png" alt srcset />
                    <h4>Valorant SMA</h4>
                    <div class="content__">
                        <div
                            v-if="data.valorantsma"
                            style="display: flex;flex-direction: column;padding: 8px;box-sizing: border-box;"
                        >
                            <p
                                v-if="data.valorantsma.status == 'draft'"
                            >Telah Mendaftar dan Formulir belum dikirim</p>
                            <p
                                v-else-if="data.valorantsma.status == 'sended' && data.valorantsma.team_verified_at"
                            >Formulir Terverifikasi</p>
                            <p v-else>Formulir telah dikirim</p>
                            <div
                                class="mt-2 d-flex align-items-center"
                                style="justify-content: space-evenly;"
                            >
                                <Button
                                    @click="$router.push('/dashboard/valorant-sma')"
                                    style="display: block;width: 85%;"
                                >Lihat Formulir</Button>
                                <Button
                                    v-if="data.valorantsma.status == 'draft'"
                                    @click="deleteCompetition(data.valorantsma.id)"
                                    icon="ios-trash"
                                    type="error"
                                    ghost
                                ></Button>
                            </div>
                        </div>
                        <Button v-else @click="showValorantSmaTeam=true">Daftar Sekarang</Button>
                    </div>
                </div>
            </div>
        </Content>

        <!-- Modal -->
        <ModalMLTeam :showModal="showMlTeam" @change="(e)=>showMlTeam = e" />
        <ModalMLSmaTeam :showModal="showMlSmaTeam" @change="(e)=>showMlSmaTeam = e" />
        <ModalPubgTeam :showModal="showPubgTeam" @change="(e)=>showPubgTeam = e" />
        <ModalPubgSmaTeam :showModal="showPubgSmaTeam" @change="(e)=>showPubgSmaTeam = e" />
        <ModalValorantTeam :showModal="showValorantTeam" @change="(e)=>showValorantTeam = e" />
        <ModalValorantSmaTeam :showModal="showValorantSmaTeam" @change="(e)=>showValorantSmaTeam = e" />
        <ModalSinematografiTeam
            :showModal="showSinematografiTeam"
            @change="(e)=>showSinematografiTeam = e"
        />
        <ModalPadusTeam :showModal="showPadusTeam" @change="(e)=>showPadusTeam = e" />
        <ModalCaturTeam :showModal="showCaturTeam" @change="(e)=>showCaturTeam = e" />
    </div>
</template>

<style lang="scss" scoped>
.container_lomba {
    display: grid;
    padding: 0 50px;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 18px;
    padding-bottom: 50px;

    .card__ {
        position: relative;

        border-radius: 4px;
        overflow: hidden;
        background-color: #fff;

        .thumbnail__ {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        h4 {
            position: absolute;
            top: 119px;
            left: 18px;
            color: black;
        }
        .content__ {
            display: grid;
            justify-content: center;
            align-items: center;
            min-height: 100px;
        }
    }
}
</style>

<script>
import Sidebar from "../../components/user/Sidebar";
import Content from "../../components/user/Content";
import ModalMLTeam from "../../components/user/ModalMLTeam";
import ModalMLSmaTeam from "../../components/user/ModalMLSmaTeam";
import ModalPubgTeam from "../../components/user/ModalPubgTeam";
import ModalPubgSmaTeam from "../../components/user/ModalPubgSmaTeam";
import ModalValorantTeam from "../../components/user/ModalValorantTeam";
import ModalValorantSmaTeam from "../../components/user/ModalValorantSmaTeam";
import ModalSinematografiTeam from "../../components/user/ModalSinematografiTeam";
import ModalPadusTeam from "../../components/user/ModalPadusTeam";
import ModalCaturTeam from "../../components/user/ModalCaturTeam";

export default {
    data() {
        return {
            showMlTeam: false,
            showMlSmaTeam: false,
            showPubgTeam: false,
            showPubgSmaTeam: false,
            showValorantTeam: false,
            showValorantSmaTeam: false,
            showSinematografiTeam: false,
            showPadusTeam: false,
            showCaturTeam: false,
            data: {
                ml: null,
                mlsma: null,
                pubg: null,
                pubgsma: null,
                padus: null,
                catur: null,
                sinematografi: null,
                valorant :null,
                valorantsma :null,
            },
        };
    },

    created() {
        this.getData();
    },

    methods: {
        async getData() {
            var res = await this.callApi("get", "/client/competition");

            if (res.status == 200) {
                this.data.pubg = res.data.find(({ type }) => type == "pubg");
                this.data.pubgsma = res.data.find(({ type }) => type == "pubgsma");
                this.data.valorant = res.data.find(({ type }) => type == "valorant");
                this.data.valorantsma = res.data.find(({ type }) => type == "valorantsma");
                this.data.ml = res.data.find(({ type }) => type == "ml");
                this.data.mlsma = res.data.find(({ type }) => type == "mlsma");
                this.data.padus = res.data.find(({ type }) => type == "padus");
                this.data.catur = res.data.find(({ type }) => type == "catur");
                this.data.sinematografi = res.data.find(
                    ({ type }) => type == "sinematografi"
                );
            }
        },
        deleteCompetition(id) {
            this.$Modal.confirm({
                title: "Hapus Formulir Lomba?",
                onOk: async () => {
                    var res = await this.callApi(
                        "post",
                        `/client/competition/${id}`
                    );

                    if (res.status == 200) {
                        this.$Message.info("Formulir berhasi dihapus");
                        this.getData();
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
        ModalMLTeam,
        ModalMLSmaTeam,
        ModalPubgTeam,
        ModalPubgSmaTeam,
        ModalSinematografiTeam,
        ModalPadusTeam,
        ModalValorantTeam,
        ModalValorantSmaTeam,
        ModalCaturTeam,
    },
};
</script>
