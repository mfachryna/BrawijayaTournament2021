<template>
    <div>
        <Sidebar />
        <Content title="Klasemen">
            <Button class="btn-create" icon="ios-add">Buat Klasemen</Button>
        </Content>
    </div>
</template>

<script>
import Sidebar from "../../components/admin/Sidebar";
import Content from "../../components/admin/Content";

export default {
    data() {
        return {};
    },
    components: {
        Sidebar,
        Content,
    },
};
</script>
