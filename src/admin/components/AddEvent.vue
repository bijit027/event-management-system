<template>
<el-card class="box-card">
<div class="container">

    
    <div class="wrap">

        <el-form label-width="100px">
            <div class="form-item">
                <el-form-item label="Event Title">
                    <el-col >
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
                        <el-option label="Zone one" value="shanghai" />
                        <el-option label="Zone two" value="beijing" />
                    </el-select>
                </el-col>
            </el-form-item>
            <el-form-item label="Online Event" >
                <el-radio-group v-model="event.onlineEvent">
                    <el-radio label="Yes"  />
                    <el-radio label="No" />

                </el-radio-group>
            </el-form-item>
            <el-form-item label="Banner Url">
                <el-col :span="8">
                    <el-input  v-model="event.url" />
                </el-col>
            </el-form-item>

            <el-form-item label="Event Date">
                <el-col :span="8">
                    <el-date-picker type="date" placeholder="Pick a date" style="width: 100%"  v-model="event.startingDate"/>
                </el-col>

            </el-form-item>

            <el-form-item label="ending Time">

                <el-col :span="8">
                    <el-time-picker type="time" placeholder="Pick a time" style="width: 100%"  v-model="event.startingTime" />
                </el-col>

            </el-form-item>

            <el-form-item label="End time">
                <el-col :span="8">
                    <el-date-picker type="date" placeholder="Pick a date" style="width: 100%"  v-model="event.endingDate"/>
                </el-col>
                <!-- <div class="timePicker">Pick time</div>
                <el-col :span="8">
                    <el-time-picker  placeholder="Pick a time" style="width: 100%" />
                </el-col> -->
            </el-form-item>
            <el-form-item label="Ending Time">

                <el-col :span="8">
                    <el-time-picker type="time" placeholder="Pick a time" style="width: 100%" v-model="event.endingTime" />
                </el-col>

            </el-form-item>
            <el-form-item label="Limit">
                <el-col :span="8">
                    <el-input-number :min="1" v-model="event.limit"/>
                </el-col>
            </el-form-item>
            <el-form-item label="Deadline">
                <el-col :span="8">
                    <el-date-picker type="date" placeholder="Pick a date" style="width: 100%" v-model="event.deadline"/>
                </el-col>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="onSubmit">Create</el-button>
            </el-form-item>
        </el-form>
    </div>
</div>
</el-card>
</template>

<script>
export default {

    data: function () {
        return {
            event: {
                title: '',
                details: '',
                category: '',
                onlineEvent: '',
                url: '',
                startingDate: '',
                startingTime:'',
                endingDate: '',
                endingTime:'',
                limit: '',
                deadline: '',
                button: 'Create',
            },
           
            showSuccess: '',
            showError: '',
        }
    },


        methods: {
        onSubmit() {
          console.log(this.event);
          const that = this;
            console.log(ajax_url.ajaxurl);
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_insert_event_data",
                    title: that.event.title,
                    details: that.event.details,
                    category: that.event.category,
                    onlineEvent: that.event.onlineEvent,
                    url: that.event.url,
                    startingDate: that.event.startingDate,
                    startingTime: that.event.startingTime,
                    endingDate: that.event.endingDate,
                    endingTime: that.event.endingTime,
                    limit: that.event.limit,
                    deadline: that.event.deadline,
   
                    ems_nonce: ajax_url.ems_nonce,
                },
                success: function (data) {


                    // that.mydata = data.data;
                    // setTimeout(function () {
                    //     that.$router.push({
                    //         name: "ContactManager"
                    //     });
                    // }, 500);

                },
                error: function (error) {
                    that.showError = 'Something went wrong';
                   
                     }
        });

        }
    }
   
        
    }
</script>

<style scoped>
.container {
    width: 100%;
    padding: 10px;
}

/* .wrap{
      margin: 25px 50px 75px 100px;
  } */
.timePicker {
    margin-left: 20px;
    margin-right: 10px;
}
.box-card{
    width: 60%;
    margin: auto;
    margin-top: 50px;
    /* margin: 50px 50px 50px 50px; */
}
</style>
