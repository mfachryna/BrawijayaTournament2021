<template>
    <div class="sidebar">
        <div class="profile">
            <h2 class="name">{{name}}</h2>
            <p>{{email}}</p>
        </div>
        <ul class="menu">
            <li class="label">Main</li>
            <li class="menu-item">
                <router-link to="/admin">
                    <Icon type="ios-home" />
                    <span>Dashboard</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/admin/pengumuman">
                    <Icon type="md-megaphone" />
                    <span>Pengumuman</span>
                </router-link>
            </li>
        </ul>
        <ul class="menu">
            <li class="label">Cabang Lomba</li>
            <li class="menu-item">
                <router-link to="/admin/pubg">
                    <Icon type="md-medal" />
                    <span>PUBG</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/admin/mobile-legends">
                    <Icon type="md-medal" />
                    <span>Mobile Legends</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/admin/valorant">
                    <Icon type="md-medal" />
                    <span>Valorant</span>
                </router-link>
            </li>
             <li class="menu-item">
                <router-link to="/admin/pubg-sma">
                    <Icon type="md-medal" />
                    <span>PUBG SMA</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/admin/mobile-legends-sma">
                    <Icon type="md-medal" />
                    <span>Mobile Legends SMA</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/admin/valorant-sma">
                    <Icon type="md-medal" />
                    <span>Valorant SMA</span>
                </router-link>
            </li>
        </ul>
        <ul class="menu">
            <li class="label">Halaman</li>
            <li class="menu-item">
                <router-link to="/admin/berita">
                    <Icon type="logo-rss" />
                    <span>Berita</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link to="/admin/galeri">
                    <Icon type="md-image" />
                    <span>Galeri</span>
                </router-link>
            </li>
            <!-- <li class="menu-item">
                <router-link to="/admin/klasemen">
                    <Icon type="md-podium" />
                    <span>Klasemen</span>
                </router-link>
            </li>-->
            <li class="menu-item">
                <router-link to="/admin/jadwal">
                    <Icon type="md-calendar" />
                    <span>Jadwal</span>
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
