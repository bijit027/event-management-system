<template>
<el-card class="box-card">
    <div class="container">

        <div class="wrap">
            <el-form label-width="100px">
                <div class="form-item">
                    <el-form-item label="Event Title">
                        <el-col>
                            <el-input type="text" size="large" v-model="event.title" />
                        </el-col>
                    </el-form-item>
                </div>
                <el-form-item label="Event Details">
                    <el-col>
                        <el-input type="textarea" v-model="event.details" />
                    </el-col>
                </el-form-item>
                <el-form-item label="Category">
                    <el-col :span="8">
                        <el-select placeholder="Please select your category" v-model="event.category">
                            <el-option v-for="value in category" :key="value.term_id" :label="value.name" :value="value.name" />
                        </el-select>
                    </el-col>
                </el-form-item>
                <el-form-item label="Organizer">
                    <el-col :span="8">
                        <el-select placeholder="Select Organizer" v-model="event.organizer">
                            <el-option v-for="value in organizer" :key="value.ID" :label="value.name" :value="value.name" />
                        </el-select>
                    </el-col>
                </el-form-item>
                <el-form-item label="Online Event">
                    <el-radio-group v-model="event.onlineEvent">
                        <el-radio label="Yes" />
                        <el-radio label="No" />

                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Banner Url">
                    <el-col :span="8">
                        <el-input v-model="event.url" />
                    </el-col>
                </el-form-item>

                <el-form-item label="Event Date">
                    <el-col :span="8">
                        <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="event.startingDate" />
                    </el-col>
                </el-form-item>

                <el-form-item label="ending Time">

                    <el-col :span="8">
                        <el-time-picker type="time" placeholder="Pick a time" style="width: 100%" v-model="event.startingTime" />
                    </el-col>
                </el-form-item>

                <el-form-item label="End time">
                    <el-col :span="8">
                        <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="event.endingDate" />
                    </el-col>
                </el-form-item>
                <el-form-item label="Ending Time">

                    <el-col :span="8">
                        <el-time-picker type="time" placeholder="Pick a time" style="width: 100%" v-model="event.endingTime" />
                    </el-col>

                </el-form-item>
                <el-form-item label="Limit">
                    <el-col :span="8">
                        <el-input-number :min="1" v-model="event.limit" />
                    </el-col>
                </el-form-item>
                <el-form-item label="Deadline">
                    <el-col :span="8">
                        <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="event.deadline" />
                    </el-col>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit">{{ event.button }}</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</el-card>
</template>

<script>
export default {

    props: ['event'],
    emits: ["form-submit"],

    data() {
        return {
            category: {},
            organizer: {},
        }
    },

    mounted() {

        this.fetchCategory();
        this.fetchOrganizer();
    },
    methods: {
        fetchCategory() {
            const that = this;
            jQuery.ajax({
                type: "GET",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_get_event_category_data",
                },
                success: function (data) {
                    that.category = data.data;
                }
            });

        },
        fetchOrganizer() {
            const that = this;
            jQuery.ajax({
                type: "GET",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_get_organizer_data",
                },
                success: function (data) {
                    that.organizer = data.data;
                    console.log(that.organizer);
                }
            });

        },
        onSubmit() {
            this.$emit("form-submit", this.event);
        }
    },
}
</script>

<style scoped>
.container {
    width: 100%;
    padding: 10px;
}

.timePicker {
    margin-left: 20px;
    margin-right: 10px;
}

.box-card {
    width: 60%;
    margin: auto;
    margin-top: 50px;
}
</style>
