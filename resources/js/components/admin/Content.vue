<template >
    <div style="overflow-y:auto">
        <div class="header">
            <div class="brand">
                <img class="logo" src="../../../assets/bt-logo.png" alt />
                <div class="text">
                    <h1>Brawijaya Tournament</h1>
                    <p>SATU CITA - SATU TEKAD - BRAWIJAYA JUARA</p>
                </div>
            </div>
            <button @click="logout" class="btn-logout">Keluar</button>
            <form ref="form" action="/logout" method="POST" style="display:none;">
                <input type="hidden" name="_token" :value="csrf" />
            </form>
        </div>
        <div class="content">
            <h2 class="title">{{title}}</h2>
            <div class="content_slot">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.header {
    height: 260px;
    background-color: #ae3475;
    position: relative;

    .btn-logout {
        position: absolute;
        top: 18px;
        right: 18px;
        outline: none;
        border: none;
        background: none;
        color: white;
        cursor: pointer;
        transition: all 0.5s;
        padding: 8px 18px;
        &:hover {
            background: rgba(255, 255, 255, 0.294);
        }
    }

    .brand {
        padding-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        .logo {
            width: 100px;
            object-fit: cover;
        }
        .text {
            color: white;

            h1,
            p {
                margin: 0;
            }
        }
    }
}
.content {
    position: relative;
    margin: 0 50px;
    transform: translateY(-70px);
    background: linear-gradient(
        180deg,
        #ffffff 41.47%,
        rgba(255, 255, 255, 0) 91.15%
    );
    border-radius: 4px;
    min-height: 200px;
    padding-bottom: 50px;

    .title {
        padding-left: 50px;
        padding-top: 30px;
        font-weight: 600;
    }
    .content_slot {
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;

        .btn-create {
            position: absolute;
            top: -44px;
            right: 50px;
        }
    }
}
</style>

<script>
export default {
    props: ["title"],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    methods: {
        logout() {
            this.$refs.form.submit();
        },
    },
};
</script>
