<template>
    <div class="sidebar">
        <div class="profile">
            <h2 class="name">{{name}}</h2>
            <p>{{email}}</p>
        </div>
        <ul class="menu">
            <li class="menu-item">
                <router-link to="/dashboard">
                    <Icon type="ios-home" />
                    <span>Dashboard</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/dashboard/pengumuman">
                    <Icon type="md-megaphone" />
                    <span>Pengumuman</span>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
        };
    },
    created() {
        this.name = $("#app").attr("name");
        this.email = $("#app").attr("email");
    },
};
</script>
