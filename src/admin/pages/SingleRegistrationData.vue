<template>
<div class="container">
    <el-row>
        <div class="description">
            <h1>hello</h1>

            <!-- <el-card>

        <img :src="value.url" class="image" />
        <el-descriptions title="Event Information">        
            <el-descriptions-item label="Title:"><span class="event_value">{{value.title}}</span></el-descriptions-item>
            <el-descriptions-item label="Details:"><span class="event_value">{{value.details}}</span></el-descriptions-item>
            <el-descriptions-item label="Category:"><span class="event_value">{{value.category}}</span></el-descriptions-item>
            <el-descriptions-item label="Organizer:"><span class="event_value">{{value.organizer}}</span></el-descriptions-item>
            <el-descriptions-item label="Online Event:"><span class="event_value">{{value.onlineEvent}}</span></el-descriptions-item>
            <el-descriptions-item label="Starting Date:"><span class="event_value">{{value.startingDate}}</span></el-descriptions-item>
            <el-descriptions-item label="Starting Time:"><span class="event_value">{{value.startingTime}}</span></el-descriptions-item>
            <el-descriptions-item label="Ending Date:"><span class="event_value">{{value.endingDate}}</span></el-descriptions-item>
            <el-descriptions-item label="Ending Time:"><span class="event_value">{{value.endingTime}}</span></el-descriptions-item>
            <el-descriptions-item label="Location:"><span class="event_value">{{value.location}}</span></el-descriptions-item>
            <el-descriptions-item label="Limit:"><span class="event_value">{{value.limit}}</span></el-descriptions-item>
            <el-descriptions-item label="Deadline:"><span class="event_value">{{value.deadline}}</span></el-descriptions-item>
            </el-descriptions>
        </el-card> -->

            <el-card class="box-card">
                <template #header>
                    <div class="card-header">
                        <span>Card name</span>
                        <el-button class="button" text>Operation button</el-button>
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
</style>
