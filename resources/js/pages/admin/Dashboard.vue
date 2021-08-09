<template>
    <div>
        <Sidebar />
        <Content title="Cabang Lomba">
            <div class="card-container">
                <div class="card__">
                    <h2>PUBG</h2>
                    <div class="d-flex justify-content-between">
                        <p>Pendaftar</p>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3>{{pubg.total}}</h3>
                        <h3>{{pubg.verified}}</h3>
                    </div>
                </div>
                <div class="card__">
                    <h2>Mobile Legends</h2>
                    <div class="d-flex justify-content-between">
                        <p>Pendaftar</p>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3>{{ml.total}}</h3>
                        <h3>{{ml.verified}}</h3>
                    </div>
                </div>
                <div class="card__">
                    <h2>Valorant</h2>
                    <div class="d-flex justify-content-between">
                        <p>Pendaftar</p>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3>{{valorant.total}}</h3>
                        <h3>{{valorant.verified}}</h3>
                    </div>
                </div>
                <div class="card__">
                    <h2>PUBG SMA/MA</h2>
                    <div class="d-flex justify-content-between">
                        <p>Pendaftar</p>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3>{{pubgsma.total}}</h3>
                        <h3>{{pubgsma.verified}}</h3>
                    </div>
                </div>
                <div class="card__">
                    <h2>Mobile Legends SMA/MA</h2>
                    <div class="d-flex justify-content-between">
                        <p>Pendaftar</p>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3>{{mlsma.total}}</h3>
                        <h3>{{mlsma.verified}}</h3>
                    </div>
                </div>
                <div class="card__">
                    <h2>Valorant SMA/MA</h2>
                    <div class="d-flex justify-content-between">
                        <p>Pendaftar</p>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3>{{valorantsma.total}}</h3>
                        <h3>{{valorantsma.verified}}</h3>
                    </div>
                </div>
            </div>
        </Content>
    </div>
</template>

<style lang="scss">
.card-container {
    display: flex;
    flex-wrap: wrap;
    padding: 0 50px;
    box-sizing: border-box;
    gap: 18px;

    .card__ {
        min-width: 300px;
        max-width: 400px;
        padding: 18px;
        box-sizing: border-box;
        background: white;
        border-radius: 4px;

        h2 {
            font-size: 1.5em;
        }
    }
}
</style>

<script>
import Sidebar from "../../components/admin/Sidebar";
import Content from "../../components/admin/Content";

export default {
    data() {
        return {
            pubg: {
                total: 0,
                verified: 0,
            },
            ml: {
                total: 0,
                verified: 0,
            },
            valorant: {
                total: 0,
                verified: 0,
            },
            pubgsma: {
                total: 0,
                verified: 0,
            },
            mlsma: {
                total: 0,
                verified: 0,
            },
            valorantsma: {
                total: 0,
                verified: 0,
            },
            padus: {
                total: 0,
                verified: 0,
            },
            sinematografi: {
                total: 0,
                verified: 0,
            },
            catur: {
                total: 0,
                verified: 0,
            },
        };
    },
    async created() {
        var res = await this.callApi("get", "/app/overview");

        if (res.status == 200) {
            if (res.data.find(({ type }) => type == "catur"))
                this.catur = res.data.find(({ type }) => type == "catur");
            if (res.data.find(({ type }) => type == "pubg"))
                this.pubg = res.data.find(({ type }) => type == "pubg");
            if (res.data.find(({ type }) => type == "pubgsma"))
                this.pubgsma = res.data.find(({ type }) => type == "pubgsma");
            if (res.data.find(({ type }) => type == "ml"))
                this.ml = res.data.find(({ type }) => type == "ml");
            if (res.data.find(({ type }) => type == "valorant"))
                this.valorant = res.data.find(({ type }) => type == "valorant");
            if (res.data.find(({ type }) => type == "mlsma"))
                this.mlsma = res.data.find(({ type }) => type == "mlsma");
            if (res.data.find(({ type }) => type == "valorantsma"))
                this.valorantsma = res.data.find(({ type }) => type == "valorantsma");
            if (res.data.find(({ type }) => type == "padus"))
                this.padus = res.data.find(({ type }) => type == "padus");

            if (res.data.find(({ type }) => type == "sinematografi"))
                this.sinematografi = res.data.find(
                    ({ type }) => type == "sinematografi"
                );
        }
    },
    components: {
        Sidebar,
        Content,
    },
};
</script>
