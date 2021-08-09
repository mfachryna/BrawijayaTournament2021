import Router from "vue-router";
import Vue from "vue";

Vue.use(Router);

import adminDashboard from "./pages/admin/Dashboard";
import adminMobileLegends from "./pages/admin/MobileLegends";
import adminMobileLegendsSma from "./pages/admin/MobileLegendsSma";
import adminCatur from "./pages/admin/Catur";
import adminPaduanSuara from "./pages/admin/PaduanSuara";
import adminPUBG from "./pages/admin/PUBG";
import adminPUBGSma from "./pages/admin/PUBGSma";
import adminSinematografi from "./pages/admin/Sinematografi";
import adminPengumuman from "./pages/admin/Pengumuman";
import adminBerita from "./pages/admin/Berita";
import adminGaleri from "./pages/admin/Galeri";
import adminKlasemen from "./pages/admin/Klasemen";
import adminCreatePengumuman from "./pages/admin/CreatePengumuman";
import adminCreateBerita from "./pages/admin/CreateBerita";
import adminValorant from "./pages/admin/Valorant";
import adminValorantSma from "./pages/admin/ValorantSma";
import adminJadwal from "./pages/admin/Jadwal";

import userDashboard from "./pages/user/Dashboard";
import userPengumuman from "./pages/user/Pengumuman";
import userMobileLegends from "./pages/user/MobileLegends";
import userMobileLegendsSma from "./pages/user/MobileLegendsSma";
import userPUBG from "./pages/user/PUBG";
import userPUBGsma from "./pages/user/PUBGsma";
import userPaduanSuara from "./pages/user/PaduanSuara";
import userSinematografi from "./pages/user/Sinematografi";
import userCatur from "./pages/user/Catur";
import userValorant from "./pages/user/Valorant";
import userValorantSma from "./pages/user/ValorantSma";
import userDetailPengumuman from "./pages/user/DetailPengumuman";

const routes = [
    {
        name: "Dashboard Admin",
        path: "/admin",
        component: adminDashboard
    },
    {
        name: "Dashboard",
        path: "/admin/dashboard",
        component: adminDashboard
    },
    {
        name: "Pengumuman",
        path: "/admin/pengumuman",
        component: adminPengumuman
    },
    {
        name: "Mobile Legends",
        path: "/admin/mobile-legends",
        component: adminMobileLegends
    },
    {
        name: "Mobile Legends SMA",
        path: "/admin/mobile-legends-sma",
        component: adminMobileLegendsSma
    },
    {
        name: "Catur",
        path: "/admin/catur",
        component: adminCatur
    },
    {
        name: "Valorant",
        path: "/admin/valorant",
        component: adminValorant
    },
    {
        name: "Valorant SMA",
        path: "/admin/valorant-sma",
        component: adminValorantSma
    },
    {
        name: "Paduan Suara",
        path: "/admin/paduan-suara",
        component: adminPaduanSuara
    },
    {
        name: "PUBG",
        path: "/admin/pubg",
        component: adminPUBG
    },
    {
        name: "PUBG SMA",
        path: "/admin/pubg-sma",
        component: adminPUBGSma
    },
    {
        name: "Sinematografi",
        path: "/admin/sinematografi",
        component: adminSinematografi
    },
    {
        name: "Berita",
        path: "/admin/berita",
        component: adminBerita
    },
    {
        name: "Galeri",
        path: "/admin/galeri",
        component: adminGaleri
    },
    {
        name: "Klasemen",
        path: "/admin/klasemen",
        component: adminKlasemen
    },
    {
        name: "Jadwal",
        path: "/admin/jadwal",
        component: adminJadwal
    },
    {
        name: "createPengumuman",
        path: "/admin/pengumuman/:id/edit",
        component: adminCreatePengumuman
    },
    {
        name: "createBerita",
        path: "/admin/berita/:id/edit",
        component: adminCreateBerita
    },

    // User
    {
        path: "/dashboard",
        component: userDashboard
    },
    {
        path: "/dashboard/pengumuman",
        component: userPengumuman
    },
    {
        path: "/dashboard/mobile-legends",
        component: userMobileLegends
    },
    {
        path: "/dashboard/mobile-legends-sma",
        component: userMobileLegendsSma
    },
    {
        path: "/dashboard/pubg",
        component: userPUBG
    },
    {
        path: "/dashboard/pubgsma",
        component: userPUBGsma
    },
    {
        path: "/dashboard/paduan-suara",
        component: userPaduanSuara
    },
    {
        path: "/dashboard/sinematografi",
        component: userSinematografi
    },
    {
        path: "/dashboard/catur",
        component: userCatur
    },
    {
        path: "/dashboard/valorant",
        component: userValorant
    },
    {
        path: "/dashboard/valorant-sma",
        component: userValorantSma
    },
    {
        name: "userDetailPengumuman",
        path: "/dashboard/pengumuman/:slug",
        component: userDetailPengumuman
    }
];

export default new Router({
    mode: "history",
    routes
});
