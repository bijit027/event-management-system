<template>
 <el-main>
<div>
    <h2>ALL Events</h2>
    {{ events.ID }}
</div>
<el-button type="primary" @click="addEvent()">Add Event</el-button>

<el-table :data="events" style="width: 100%">
    <el-table-column label="Date" prop="post_date" />
    <el-table-column label="Event" prop="post_title" />
    <el-table-column align="right">
        <template #default="scope">
            <el-button size="small" type="primary" @click="showData(scope.$index, scope.row)">View</el-button>
            <el-button size="small" @click="editEventData(scope.$index, scope.row)">Edit</el-button>
            <el-button size="small" type="danger" @click="deletEvent(scope.$index, scope.row)">Delete</el-button>

        </template>
    </el-table-column>
</el-table>
 </el-main>
</template>

<script>
import {
    ElButton,ElMessage
} from 'element-plus'
export default {
    components: {
        ElButton
    },

    data() {
        return {
            loading: false,
            events: [],
            errorMessage: null,
            showSuccess: '',
            showError: '',
        }
    },

    mounted() {

        this.fetchData();
    },
    methods: {
      editEventData(index,row){
                    this.$router.push({
                path: `/edit-event/${row.ID}`
            })

      },
      addEvent(){
            this.$router.push({
                path: `/addEvent`
            })
      },
        deletEvent(index, row) {
            const that = this;
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_delete_event",
                    id: row.ID,
                    ems_nonce: ajax_url.ems_nonce,
                },
                success: function (data) {

                    ElMessage({
                        showClose: true,
                        message: 'Successfully deleted data',
                        type: 'success',
                    })

                },
                error: function (error) {
                    that.showError = 'Something went wrong';
                    that.errors = error.responseJSON.data;

                },
            });
        },
        showData(index, row) {
            this.$router.push({
                path: `/show-event/${row.ID}`
            })

        },
        fetchData() {
            const that = this;
            jQuery.ajax({
                type: "GET",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_get_event_data",
                },
                success: function (data) {
                    that.events = data.data;
                }
            });

        },
    }

}
</script>

<style scoped>

</style>
