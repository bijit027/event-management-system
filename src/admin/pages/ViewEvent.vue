<template>
<div class="container">
    <el-row>
        <el-col :span="13" :offset="index > 0 ? 2 : 0">
            <el-card :body-style="{ padding: '0px' }">
                <img :src="value.url" class="image" />
                <div style="padding: 25px">
                    <div class="title">
                        Title: {{value.title}}
                    </div><br>
                    <div class="title">Details:<div class=""> {{value.details}}</div></div><br>
                    <div class="title">Category: {{value.category}}</div><br>
                    <div class="title">Organizer: {{value.organizer}}</div><br>
                    <div class="title">Event Type: {{value.onlineEvent}}</div><br>
                    <div class="title">Starting Date: {{value.startingDate}}</div><br>
                    <div class="title">Starting Time: {{value.startingTime}}</div><br>
                    <div class="title">Ending Date: {{value.endingDate}}</div><br>
                    <div class="title">Ending Time: {{value.endingTime}}</div><br>
                    <div class="title">Limit: {{value.limit}}</div><br>
                    <div class="title">Deadline: {{value.deadline}}</div><br>
                </div>
            </el-card>
        </el-col>
    </el-row>
</div>
</template>

<script>
export default {
    data() {
        return {
            eventID: this.$route.params.eventID,
            events: {},
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
                    action: "ems_get_single_event_data",
                    id: that.eventID
                },
                success: function (data) {
                    that.events = data.data;
                    that.value = JSON.parse(that.events.eventData);
                }
            });

        }
    }

}
</script>

<style scoped>
.time {
    font-size: 12px;
    color: #999;
}

.bottom {
    margin-top: 13px;
    line-height: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.button {
    padding: 0;
    min-height: auto;
}

.image {
    width: 100%;
    display: block;
}

.container {
    margin-left: 25%;
    margin-top: 100px
}

.title {
    float: left;
    font-weight: bold;
    color: rgb(105, 115, 134);
}

</style>
