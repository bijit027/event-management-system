<template>
<div class="container">
    <el-row>
        <div class="description">
            <el-card class="box-card">
                <template #header>
                    <div class="card-header">
                        <span>Registry Information</span>
                        
                    </div>
                </template>
                <div class="text item">
                    Name: {{value.name}}
                </div>
                <div class="text item">
                    Email: {{value.email}}
                </div>
                <div class="text item">
                    Event Name: {{value.eventTitle}}
                </div>
            </el-card>
        </div>
    </el-row>
</div>
</template>

<script>
export default {
    data() {
        return {
            applicantId: this.$route.params.applicantId,
            registration: {},
            value: {}
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            const that = this;
            jQuery.ajax({
                type: "GET",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_get_single_registration_data",
                    id: that.applicantId
                },
                success: function (data) {
                    that.registration = data.data;
                    console.log(that.event);
                    that.value = JSON.parse(that.registration.registrationData);
                    console.log(value);
                    // console.log(that.event);
                }
            });

        }
    }

}
</script>

<style scoped>
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.text {
    font-size: 14px;
}

.item {
    margin-bottom: 18px;
}

.box-card {
    width: 480px;
}

.container {
    margin-left: 25%;
    margin-top: 100px
}
</style>
