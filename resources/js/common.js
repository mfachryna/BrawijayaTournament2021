export default {
    data() {
        return {};
    },
    methods: {
        async callApi(method = "get", url, dataObj) {
            this.$Loading.start();
            try {
                let data = await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
                this.$Loading.finish();
                return data;
            } catch (err) {
                this.$Loading.error();
                return err.response;
            }
        }
    }
};
