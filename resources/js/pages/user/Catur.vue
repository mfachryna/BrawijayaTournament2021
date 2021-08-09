<template>
    <div>
        <header class="header">
            <div class="brand">
                <img class="logo" src="../../../assets/bt-logo.png" alt />
                <div class="text">
                    <h1>Brawijaya Tournament</h1>
                    <p>SATU CITA - SATU TEKAD - BRAWIJAYA JUARA</p>
                </div>
            </div>
            <button @click="$router.push('/dashboard')" class="btn">Simpan dan Keluar</button>
        </header>
        <div v-if="data" class="content__">
            <h2 class="h2">Form Pendaftaran Tim Catur</h2>
            <div class="info__">
                <div class="card__ mb-3">
                    <p>Nama Universitas</p>
                    <h2>{{data.university}}</h2>
                    <p>Lampiran *.pdf</p>
                    <Upload
                        v-if="!data.lampiran || data.lampiran == '' "
                        ref="lampiran"
                        action="/client/upload_lampiran"
                        :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                        :format="['pdf']"
                        :max-size="2048"
                        :before-upload="handleBeforeUploadLampiran"
                        :on-format-error="handleLampiranFormatError"
                        :on-exceeded-size="handleMaxSize"
                        :on-success="handleSuccessLampiran"
                        :on-remove="handleRemoveLampiran"
                    >
                        <Button
                            size="small"
                            icon="ios-cloud-upload-outline"
                        >Upload Surat Rekomendasi</Button>
                    </Upload>
                    <p v-else class="pb-3 d-block text-dark">
                        Surat rekomendasi perguruan tinggi
                        <a
                            :href="data.lampiran"
                            download
                        >(Download)</a>
                        <span v-if="data.status == 'draft'">
                            <a
                                v-if="!data.team_verified_at"
                                @click="deleteLampiran"
                                class="text-danger"
                            >(Hapus)</a>
                        </span>
                    </p>

                    <div class="d-flex justify-content-between counter__">
                        <div>
                            <p>
                                <span
                                    :class="caturCepat.length < minPlayerCC? 'text-danger' : 'text-primary' "
                                >{{caturCepat.length}}</span>
                                /{{maxPlayerCC}}+ Catur Cepat
                            </p>
                            <p>
                                <span
                                    :class="caturKilat.length < minPlayerCK? 'text-danger' : 'text-primary' "
                                >{{caturKilat.length}}</span>
                                /{{maxPlayerCK}}+ Catur Kilat
                            </p>
                        </div>
                        <div>
                            <p>
                                <span
                                    :class="officialCaturCepat.length < minOfficialCC? 'text-danger' : 'text-primary' "
                                >{{officialCaturCepat.length}}</span>
                                /{{maxOfficialCC}} Official
                            </p>
                            <p>
                                <span
                                    :class="officialCaturKilat.length < minOfficialCK? 'text-danger' : 'text-primary' "
                                >{{officialCaturKilat.length}}</span>
                                /{{maxOfficialCK}} Official
                            </p>
                        </div>
                    </div>
                    <div v-if="data && data.team_verified_at" class="verify">Terverifikasi</div>
                </div>
                <Upload
                    v-if="!data.pembayaran || data.pembayaran == ''"
                    ref="pembayaran"
                    action="/client/upload_pembayaran"
                    :headers="{'X-CSRF-TOKEN':token, 'X-Requested-With':'XMLHttpRequest'} "
                    :format="['jpg','jpeg','png']"
                    :max-size="2048"
                    :before-upload="handleBeforeUploadPembayaran"
                    :on-format-error="handleFormatError"
                    :on-exceeded-size="handleMaxSize"
                    :on-success="handleSuccessPembayaran"
                    :on-remove="handleRemovePembayaran"
                >
                    <Button
                        icon="ios-cloud-upload-outline"
                        class="btn__ mb-3 bg-success"
                    >Upload Bukti Pembayaran</Button>
                </Upload>
                <p v-else class="pb-3 d-block">
                    Bukti pembayaran file
                    <a :href="data.pembayaran" download>(Download)</a>
                    <span v-if="data.status == 'draft'">
                        <a
                            v-if="!data.team_verified_at"
                            @click="deletePembayaran"
                            class="text-danger"
                        >(Hapus)</a>
                    </span>
                </p>

                <Button
                    v-if="data.status == 'draft'"
                    @click="submitForm"
                    :disabled="caturCepat.length < minPlayerCC || caturKilat.length < minPlayerCK || data.pembayaran == null || data.lampiran == null"
                    class="btn__ bg-primary"
                >Kumpul Formulir</Button>
            </div>

            <div class="player__">
                <div class="card__">
                    <h2 class="d-inline-block">Catur Cepat</h2>
                    <Button
                        v-if="data.status == 'draft'"
                        :disabled="caturCepat.length == maxPlayerCC"
                        @click="showModalPlayer=true; no_pertandingan=1;"
                        size="small"
                        icon="ios-add"
                        class="float-right"
                    >Tambah Player</Button>
                    <table class="table__" width="100%">
                        <thead>
                            <td style="width:5%">No</td>
                            <td>NIM</td>
                            <td>Nama</td>

                            <td style="width:10%">Gender</td>
                            <td style="width:15%" align="center">Action</td>
                        </thead>
                        <tbody>
                            <tr v-for="(player, i) in caturCepat" :key="player.id">
                                <td>{{i+1}}</td>
                                <td>{{player.nim}}</td>
                                <td>{{player.nama}}</td>
                                <td>{{player.gender}}</td>
                                <td align="center">
                                    <Button @click="viewPlayer(player.id)" icon="md-eye"></Button>
                                    <Button
                                        v-if="data.status == 'draft'"
                                        @click="editPlayer(player.id)"
                                        type="warning"
                                        ghost
                                        icon="md-create"
                                    ></Button>
                                    <Button
                                        v-if="data.status == 'draft'"
                                        @click="deletePlayer(i, player.id, player.no_pertandingan)"
                                        type="error"
                                        ghost
                                        icon="md-trash"
                                    ></Button>
                                </td>
                            </tr>
                            <tr v-if="!caturCepat.length">
                                <td colspan="6" align="center">Tidak ada Player, Tambahkan Player</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card__">
                    <h2 class="d-inline-block">Catur Kilat</h2>
                    <Button
                        v-if="data.status == 'draft'"
                        :disabled="caturKilat.length == maxPlayerCK"
                        @click="showModalPlayer=true; no_pertandingan=2;"
                        size="small"
                        icon="ios-add"
                        class="float-right"
                    >Tambah Player</Button>
                    <table class="table__" width="100%">
                        <thead>
                            <td style="width:5%">No</td>
                            <td>NIM</td>
                            <td>Nama</td>

                            <td style="width:10%">Gender</td>
                            <td style="width:15%" align="center">Action</td>
                        </thead>
                        <tbody>
                            <tr v-for="(player, i) in caturKilat" :key="player.id">
                                <td>{{i+1}}</td>
                                <td>{{player.nim}}</td>
                                <td>{{player.nama}}</td>
                                <td>{{player.gender}}</td>
                                <td align="center">
                                    <Button @click="viewPlayer(player.id)" icon="md-eye"></Button>
                                    <Button
                                        v-if="data.status == 'draft'"
                                        @click="editPlayer(player.id)"
                                        type="warning"
                                        ghost
                                        icon="md-create"
                                    ></Button>
                                    <Button
                                        v-if="data.status == 'draft'"
                                        @click="deletePlayer(i, player.id, player.no_pertandingan)"
                                        type="error"
                                        ghost
                                        icon="md-trash"
                                    ></Button>
                                </td>
                            </tr>
                            <tr v-if="!caturKilat.length">
                                <td colspan="6" align="center">Tidak ada Player, Tambahkan Player</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <TableOfficials
                    :maxOfficial="maxOfficialCC"
                    :data="data"
                    :caturData="officialCaturCepat"
                    title="Catur Cepat"
                    type="catur"
                    @change="showModalOfficial=true; no_pertandingan=1"
                />
                <TableOfficials
                    :maxOfficial="maxOfficialCK"
                    :data="data"
                    :caturData="officialCaturKilat"
                    title="Catur Kilat"
                    type="catur"
                    @change="showModalOfficial=true; no_pertandingan=2"
                />
            </div>
            <!-- Modal -->
            <ModalPlayer
                :showModal="showModalPlayer"
                :teamid="data.id"
                comptt_name="catur"
                :no_pertandingan="no_pertandingan"
                @change="(e)=>showModalPlayer=e"
                @on-success="getTeam"
            />
            <ModalOfficial
                :showModal="showModalOfficial"
                :teamid="data.id"
                comptt_name="catur"
                :no_pertandingan="no_pertandingan"
                @change="(e)=>showModalOfficial=e"
                @on-success="getTeam"
            />
            <ModalEditPlayer
                :showModal="showModalEditPlayer"
                :data="player"
                @change="(e)=>showModalEditPlayer=e"
                @on-success="getTeam"
            />
            <ModalViewPlayer
                :showModal="showViewModal"
                :data="player"
                @change="(e)=>showViewModal = e"
            />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.user .container__ {
    display: block !important;
}
.header {
    background: #ae3475;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 30px;
    box-sizing: border-box;
    .brand {
        display: flex;
        align-items: center;

        .logo {
            height: 60px;
            object-fit: cover;
        }
        .text {
            color: white;
            h1 {
                font-size: 1.5em;
            }
            p {
                font-weight: 600;
                color: rgb(255 255 255 / 86%);
            }
        }
    }
    .btn {
        outline: none;
        border: none;
        background: none;
        color: white;
        cursor: pointer;
        transition: all 0.5s;
        font-weight: 600;
        padding: 8px 18px;
        &:hover {
            background: rgba(255, 255, 255, 0.294);
        }
    }
}
.content__ {
    display: grid;
    grid-template-areas: "h h" "i p";
    grid-template-columns: 0.4fr auto;
    grid-template-rows: min-content 1fr;
    padding: 30px;
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
            padding: 30px;
            box-sizing: border-box;
            border-radius: 4px;

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
            padding: 18px 20px;
            box-sizing: border-box;
            border-radius: 4px;

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
import ModalPlayer from "../../components/user/ModalCreatePlayer";
import ModalOfficial from "../../components/user/ModalOfficial";
import ModalEditPlayer from "../../components/user/ModalEditPlayer";
import TableOfficials from "../../components/user/TableOfficials";
import ModalViewPlayer from "../../components/user/ModalViewPlayer";

export default {
    watch: {
        data: {
            deep: true,
            handler() {
                if (this.data.players.length) {
                    this.caturCepat = this.getNoPertadingan(
                        this.data.players,
                        1
                    );
                    this.caturKilat = this.getNoPertadingan(
                        this.data.players,
                        2
                    );
                }
                if (this.data.officials.length) {
                    this.officialCaturCepat = this.getNoPertadingan(
                        this.data.officials,
                        1
                    );
                    this.officialCaturKilat = this.getNoPertadingan(
                        this.data.officials,
                        2
                    );
                }
            },
        },
    },
    data() {
        return {
            token: "",
            showModalPlayer: false,
            showModalOfficial: false,
            showViewModal: false,
            showModalEditPlayer: false,
            no_pertandingan: 1,
            player: null,
            maxPlayerCC: 999,
            maxPlayerCK: 999,
            minPlayerCC: 1,
            minPlayerCK: 1,
            maxOfficial: 1,
            minOfficial: 0,
            maxOfficialCC: 2,
            minOfficialCC: 0,
            maxOfficialCK: 2,
            minOfficialCK: 0,
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
    created() {
        this.getTeam();
    },
    methods: {
        async submitForm() {
            this.$Modal.confirm({
                title: "Kumpul Formulir?",
                content: "Formulir tidak akan bisa diubah setelah dikumpul",
                onOk: () => {
                    this.data.status = "sended";
                    this.updateTeam();
                },
                onCancel: () => {
                    return;
                },
            });
        },
        async getTeam() {
            var res = await this.callApi(
                "get",
                "/client/competition?type=catur"
            );

            if (res.status == 200) {
                this.data = res.data;
            }
        },
        async updateTeam() {
            var res = await this.callApi(
                "put",
                `/client/competition/${this.data.id}`,
                {
                    pembayaran: this.data.pembayaran,
                    lampiran: this.data.lampiran,
                    status: this.data.status,
                }
            );
            if (res.status == 200) {
            }
        },
        async deletePlayer(index, id, no) {
            this.$Modal.confirm({
                title: "Delete Player?",
                content: `<p><strong>${this.data.players[index].nama}</strong> will be destroy from database</p>`,
                onOk: async () => {
                    var res = await this.callApi(
                        "delete",
                        `/client/player/${id}`
                    );
                    if (res.status == 200) {
                        this.$Message.info("Player successfully deleted");
                        if (no == 1) {
                            this.caturCepat.splice(index, 1);
                        } else {
                            this.caturKilat.splice(index, 1);
                        }
                    } else {
                        this.$Message.error("Something went wrong");
                    }
                },
                onCancel: () => {
                    return;
                },
            });
        },
        async viewPlayer(playerID) {
            this.player = this.data.players[
                this.data.players.findIndex((x) => x.id == playerID)
            ];
            this.showViewModal = true;
        },
        async editPlayer(playerID) {
            this.player = this.data.players[
                this.data.players.findIndex((x) => x.id == playerID)
            ];
            this.showModalEditPlayer = true;
        },
        async deleteOfficial(index, id) {
            this.$Modal.confirm({
                title: "Delete Player?",
                content: `<p><strong>${this.data.officials[index].nama}</strong> will be destroy from database</p>`,
                onOk: async () => {
                    var res = await this.callApi(
                        "delete",
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
        async viewOfficial(index, id) {},
        // Lampiran
        async deleteLampiran() {
            var res = await this.callApi("post", "/client/delete_lampiran", {
                filename: this.data.lampiran,
            });

            if (res.status == 200) {
                this.data.lampiran = null;
                this.updateTeam();
            }
        },
        handleRemoveLampiran(file, fileList) {
            this.deleteLampiran();
            this.data.lampiran = null;
        },
        handleSuccessLampiran(res, file) {
            this.data.lampiran = file.response.url;
            this.$refs.lampiran.clearFiles();
            this.updateTeam();
        },
        handleBeforeUploadLampiran() {
            if (this.$refs.lampiran.fileList.length) {
                this.$refs.lampiran.clearFiles();
                this.deleteLampiran();
            }
            return true;
        },
        // Pembayaran
        async deletePembayaran() {
            var res = await this.callApi("post", "/client/delete_pembayaran", {
                filename: this.data.pembayaran,
            });

            if (res.status == 200) {
                this.data.pembayaran = null;
                this.updateTeam();
            }
        },
        handleRemovePembayaran(file, fileList) {
            this.deletePembayaran();
            this.data.pembayaran = null;
        },
        handleSuccessPembayaran(res, file) {
            this.data.pembayaran = file.response.url;
            this.$refs.pembayaran.clearFiles();
            this.updateTeam();
        },
        handleBeforeUploadPembayaran() {
            if (this.$refs.pembayaran.fileList.length) {
                this.$refs.pembayaran.clearFiles();
                this.deletePembayaran();
            }
            return true;
        },
        handleFormatError(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select jpg or png.",
            });
        },
        handleLampiranFormatError(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select pdf.",
            });
        },
        handleMaxSize(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
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
    mounted() {
        this.token = $('meta[name="csrf-token"]').attr("content");
    },
    components: {
        ModalPlayer,
        ModalOfficial,
        ModalEditPlayer,
        TableOfficials,
        ModalViewPlayer,
    },
};
</script>
