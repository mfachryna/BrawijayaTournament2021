<template>
    <Modal v-model="modalState" fullscreen :closable="false">
        <div v-if="data" class="content__">
            <h2 class="h2">
                Form Pendaftaran Tim
                <span v-if="data.type == 'ml'">Mobile Legends</span>
                <span v-else-if="data.type == 'pubg'">PUBG Mobile</span>
                <span v-else-if="data.type == 'catur'">Catur</span>
                <span v-else-if="data.type == 'padus'">Paduan Suara</span>
                <span v-else-if="data.type == 'sinematografi'">Sinematografi</span>
            </h2>
            <div class="info__">
                <div class="card__ mb-3">
                    <p>{{data.type != 'catur' ? 'Nama Tim' : 'Nama Universitas' }}</p>
                    <h2>{{data.type != 'catur' ? data.team_name: data.university}}</h2>
                    <p
                        v-if="data.type != 'catur'"
                        style="margin-bottom: 10px; color:black"
                    >{{data.university}}</p>

                    <p class="pb-3 d-block">
                        File Lampiran
                        <a
                            class="text-primary"
                            :href="data.lampiran"
                            download
                        >(Download)</a>
                    </p>

                    <div class="d-flex justify-content-between counter__">
                        <p>
                            <span
                                :class="data.players.length < minPlayer? 'text-danger' : 'text-primary' "
                            >{{data.players.length}}</span>
                            /{{maxPlayer}}
                            <span
                                v-if="data.type == 'catur'"
                            >+</span> Player
                        </p>
                        <p>
                            <span
                                :class="data.officials.length < minOfficial? 'text-danger' : 'text-primary' "
                            >{{data.officials.length}}</span>
                            /{{maxOfficial}} Official
                        </p>
                    </div>
                    <div v-if="data && data.team_verified_at" class="verify">Terverifikasi</div>
                </div>

                <p class="pb-3 d-block">
                    File Bukti pembayaran
                    <a :href="data.pembayaran" download>(Download)</a>
                </p>

                <template v-if="data.team_verified_at == null">
                    <Button @click="verifyForm" class="btn__ bg-primary">Verifikasi Formulir</Button>
                    <Button long @click="turnBackForm" class="mt-2">Kembalikan Formulir</Button>
                </template>

                <Button long type="error" ghost v-else @click="cancelVerify">Batalkan Verifikasi</Button>
            </div>

            <div class="player__">
                <div class="card__">
                    <h2 class="d-inline-block">{{caturCepat.length? 'Catur Cepat' : 'Player'}}</h2>

                    <table class="table__" width="100%">
                        <thead>
                            <td style="width:5%">No</td>
                            <td style="width:25%">NIM</td>
                            <td>Nama</td>

                            <td style="width:15%" align="center">Action</td>
                        </thead>
                        <tbody>
                            <template v-if="caturCepat.length">
                                <tr v-for="(player, i) in  caturCepat" :key="player.id">
                                    <td>{{i+1}}</td>
                                    <td>{{player.nim}}</td>
                                    <td>
                                        {{player.nama}}
                                        <strong
                                            style="color:#f90;"
                                            v-if="i==0 && (data.type == 'ml' || data.type== 'pubg')"
                                        >(Captain)</strong>
                                    </td>

                                    <td align="center">
                                        <Button @click="viewPlayer(player.id)" icon="md-eye"></Button>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr v-for="(player, i) in  data.players" :key="player.id">
                                    <td>{{i+1}}</td>
                                    <td>{{player.nim}}</td>
                                    <td>
                                        {{player.nama}}
                                        <strong
                                            style="color:#f90;"
                                            v-if="i==0 && (data.type == 'ml' || data.type== 'pubg')"
                                        >(Captain)</strong>
                                    </td>

                                    <td align="center">
                                        <Button @click="viewPlayer(player.id)" icon="md-eye"></Button>
                                    </td>
                                </tr>
                                <tr v-if="!data.players.length">
                                    <td
                                        colspan="5"
                                        align="center"
                                    >Tidak ada Player, Tambahkan Player</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="card__" v-if="caturKilat.length">
                    <h2 class="d-inline-block">Catur Kilat</h2>

                    <table class="table__" width="100%">
                        <thead>
                            <td style="width:5%">No</td>
                            <td style="width:25%">NIM</td>
                            <td>Nama</td>
                            <td style="width:20%">ID Server</td>
                            <td style="width:15%" align="center">Action</td>
                        </thead>
                        <tbody>
                            <tr v-for="(player, i) in caturKilat" :key="player.id">
                                <td>{{i+1}}</td>
                                <td>{{player.nim}}</td>
                                <td>
                                    {{player.nama}}
                                    <strong
                                        style="color:#f90;"
                                        v-if="i==0 && (data.type == 'ml' || data.type== 'pubg')"
                                    >(Captain)</strong>
                                </td>
                                <td>{{player.game_id}}</td>
                                <td align="center">
                                    <Button @click="viewPlayer(player.id)" icon="md-eye"></Button>
                                </td>
                            </tr>
                            <tr v-if="!data.players.length">
                                <td colspan="5" align="center">Tidak ada Player, Tambahkan Player</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <template v-if="officialCaturCepat.length || officialCaturKilat.length">
                    <TableOfficials
                        :maxOfficial="maxOfficial"
                        :data="data"
                        title="Catur Cepat"
                        type="catur"
                        :caturData="officialCaturCepat"
                    />
                    <TableOfficials
                        :maxOfficial="maxOfficial"
                        :data="data"
                        title="Catur Kilat"
                        type="catur"
                        :caturData="officialCaturKilat"
                    />
                </template>
                <TableOfficials v-else :maxOfficial="maxOfficial" :data="data" />
            </div>

            <!-- Modal -->
        </div>

        <div slot="footer">
            <Button size="small" type="primary" @click="$emit('change')">Exit</Button>
        </div>
        <ModalViewPlayer :showModal="viewDetail" @change="viewDetail=false" :data="player" />
    </Modal>
</template>

<style lang="scss" scoped>
.user .container__ {
    display: block !important;
}

.content__ {
    display: grid;
    grid-template-areas: "h h" "i p";
    grid-template-columns: 0.4fr auto;
    grid-template-rows: min-content 1fr;
    padding: 30px 0;
    box-sizing: border-box;
    column-gap: 18px;
    row-gap: 20px;

    .h2 {
        grid-area: h;
        font-size: 1.5em;
        font-weight: 600;
        color: black;
    }

    .info__ {
        grid-area: i;

        .ivu-upload-select {
            display: block !important;
        }

        .card__ {
            position: relative;
            background-color: #fff;
            box-sizing: border-box;
            border-radius: 4px;
            padding: 20px;
            border: 1px solid #ececec;

            .verify {
                position: absolute;
                top: 0;
                right: 0;
                transform: translateY(-50%);
                padding: 4px 15px;
                border-radius: 30px;
                background-color: #27ae60;
                color: white;
            }

            h2 {
                font-size: 1.5em;
                font-weight: 600;
                color: black;
                margin-top: 4px;
            }
            p {
                color: #b1b1b1;
                font-size: 0.9em;
            }

            .counter__ {
                margin-top: 18px;
                p {
                    font-size: 1.2em;
                    color: black;
                }
            }
        }

        .btn__ {
            display: block;
            width: 100%;
            outline: none;
            border: none;
            color: white;
            border-radius: 4px;
        }
    }

    .player__ {
        grid-area: p;

        .card__ {
            background-color: #fff;
            margin-bottom: 18px;
            padding: 18px 10px;
            box-sizing: border-box;
            border-radius: 4px;
            padding: 20px;
            border: 1px solid #ececec;

            h2 {
                font-size: 1.5em;
                font-weight: 600;
                color: black;
                margin-top: 4px;
                margin-bottom: 10px;
            }
        }

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
                    cursor: default;
                    transition: all 0.5s;
                    &:hover {
                        background-color: #fafafa;
                    }
                }
            }
        }
    }
}
</style>

<script>
import ModalViewPlayer from "./ModalViewPlayer";
import TableOfficials from "./TableOfficials";
export default {
    props: [
        "showModal",
        "teamId",
        "minPlayer",
        "minPlayer2",
        "maxPlayer",
        "maxPlayer2",
        "minOfficial",
        "maxOfficial",
    ],
    watch: {
        showModal() {
            this.modalState = this.showModal;
            if (this.showModal) {
                this.getData();
            }
        },
    },
    data() {
        return {
            viewDetail: false,
            player: {},
            modalState: this.showModal,
            data: {
                players: [],
                officials: [],
            },
            caturCepat: [],
            caturKilat: [],
            officialCaturCepat: [],
            officialCaturKilat: [],
        };
    },
    created() {},
    methods: {
        async getData() {
            var res = await this.callApi(
                "get",
                `/app/competition/${this.teamId}`
            );
            if (res.status == 200) {
                this.data = res.data;
                if (res.data.type == "catur") {
                    this.caturCepat = this.getNoPertadingan(
                        this.data.players,
                        1
                    );
                    this.caturKilat = this.getNoPertadingan(
                        this.data.players,
                        2
                    );
                    this.officialCaturCepat = this.getNoPertadingan(
                        this.data.officials,
                        1
                    );
                    this.officialCaturKilat = this.getNoPertadingan(
                        this.data.officials,
                        2
                    );
                }
            }
        },
        viewPlayer(playerID) {
            this.player = this.data.players[
                this.data.players.findIndex((x) => x.id == playerID)
            ];
            this.viewDetail = true;
        },
        async updateForm(data) {
            var res = await this.callApi(
                "post",
                `/app/competition/${this.data.id}`,
                data
            );
            if (res.status == 200) {
                this.$Message.info("Formulir Berhasil di Update");
            }
        },
        verifyForm() {
            this.$Modal.confirm({
                title: "Verifikasi Formulir?",
                onOk: () => {
                    this.data.team_verified_at = new Date();
                    this.updateForm({
                        team_verified_at: 1,
                    });
                },
                onCancel: () => {
                    return;
                },
            });
        },
        cancelVerify() {
            this.$Modal.confirm({
                title: "Batalkan Verifikasi?",
                onOk: () => {
                    this.data.team_verified_at = null;
                    this.updateForm({
                        team_verified_at: null,
                    });
                },
                onCancel: () => {
                    return;
                },
            });
        },
        turnBackForm() {
            this.$Modal.confirm({
                title: "Kembalikan Formulir?",
                onOk: () => {
                    this.data.team_verified_at = null;
                    this.updateForm({
                        team_verified_at: null,
                        status: "draft",
                    });
                    this.$emit("change");
                    this.$Message.info("Formulir berhasil dikembalikan");
                },
                onCancel: () => {
                    return;
                },
            });
        },
        getNoPertadingan(players, no) {
            var temp = [];
            players.forEach((player) => {
                if (player.no_pertandingan == no) {
                    temp.push(player);
                }
            });

            return temp;
        },
    },
    components: {
        ModalViewPlayer,
        TableOfficials,
    },
};
</script>
