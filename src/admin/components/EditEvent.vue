<template>
 <el-main>
{{ val.limit }}

<el-card class="box-card">
    <div class="container">

        <div class="wrap">

            <el-form label-width="100px">
                <div class="form-item">
                    <el-form-item label="Event Title">
                        <el-col>
                            <el-input type="text" size="large" v-model="val.title" />
                        </el-col>
                    </el-form-item>
                </div>
                <el-form-item label="Event Details">
                    <el-col>
                        <el-input type="textarea" v-model="val.details" />
                    </el-col>
                </el-form-item>
                <el-form-item label="Category">
                    <el-col :span="8">
                        <el-select placeholder="Please select your category" v-model="val.category">
                            <el-option label="Zone one" value="shanghai" />
                            <el-option label="Zone two" value="beijing" />
                        </el-select>
                    </el-col>
                </el-form-item>
                <el-form-item label="Online Event">
                    <el-radio-group v-model="val.onlineEvent">
                        <el-radio label="Yes" />
                        <el-radio label="No" />

                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Banner Url">
                    <el-col :span="8">
                        <el-input v-model="val.url" />
                    </el-col>
                </el-form-item>

                <el-form-item label="Event Date">
                    <el-col :span="8">
                        <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="val.startingDate" />
                    </el-col>

                </el-form-item>

                <el-form-item label="ending Time">

                    <el-col :span="8">
                        <el-time-picker type="time" placeholder="Pick a time" style="width: 100%" v-model="val.startingTime" />
                    </el-col>

                </el-form-item>

                <el-form-item label="End time">
                    <el-col :span="8">
                        <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="val.endingDate" />
                    </el-col>
                    <!-- <div class="timePicker">Pick time</div>
                <el-col :span="8">
                    <el-time-picker  placeholder="Pick a time" style="width: 100%" />
                </el-col> -->
                </el-form-item>
                <el-form-item label="Ending Time">

                    <el-col :span="8">
                        <el-time-picker type="time" placeholder="Pick a time" style="width: 100%" v-model="val.endingTime" />
                    </el-col>

                </el-form-item>
                <el-form-item label="Limit">
                    <el-col :span="8">
                        <el-input-number :min="1" v-model="val.limit" />
                    </el-col>
                </el-form-item>
                <el-form-item label="Deadline">
                    <el-col :span="8">
                        <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="val.deadline" />
                    </el-col>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit">Edit</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</el-card>
</el-main>
</template>

<script>
import {
    ElButton,ElMessage
} from 'element-plus'
export default {

    data() {
        return {
            eventID: this.$route.params.eventID,

            events: [],
            val: []
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
                    that.val = JSON.parse(that.events.post_content);
                    console.log(that.events);
                }
            })

        },
        onSubmit() {
            console.log(this.event);
            const that = this;
            console.log(ajax_url.ajaxurl);
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_edit_event_data",
                    id: that.eventID,
                    title: that.val.title,
                    details: that.val.details,
                    category: that.val.category,
                    onlineEvent: that.val.onlineEvent,
                    url: that.val.url,
                    startingDate: that.val.startingDate,
                    startingTime: that.val.startingTime,
                    endingDate: that.val.endingDate,
                    endingTime: that.val.endingTime,
                    limit: that.val.limit,
                    deadline: that.val.deadline,

                    ems_nonce: ajax_url.ems_nonce,
                },
                success: function (data) {
                    ElMessage({
                        showClose: true,
                        message: 'Successfully edited data',
                        type: 'success',
                    })

                    // that.mydata = data.data;
                    // setTimeout(function () {
                    //     that.$router.push({
                    //         name: "ContactManager"
                    //     });
                    // }, 500);

                },
                error: function (error) {
                    ElMessage.error('Oops, error in updating data.')
                },
            });

        }
    }

}
</script>

<style scoped>
.box-card {
    width: 60%;
    margin: auto;
    margin-top: 50px;
    /* margin: 50px 50px 50px 50px; */
}
</style>
