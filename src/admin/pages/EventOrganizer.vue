<template>
<el-main>
    <el-row justify="space-evenly">
        <el-col :span="8">
            <div class="wrap">
                <el-card shadow="never">
                    <h3>Add Organizer</h3>
                    <hr>
                    <OrganizerInputForm v-bind:eventOrganizer="eventOrganizer" @form-submit="onSubmit" />
                </el-card>
            </div>
        </el-col>
        <el-col :span="12">
            <el-table :data="organizers" style="width: 100%">
                <el-table-column label="ID" prop="term_id" />
                <el-table-column label="Name" prop="name" />

                <el-table-column align="right">
                    <template #default="scope">
                        <el-button size="small" @click="editCategroy(scope.$index, scope.row)">Edit</el-button>
                        <el-button size="small" type="danger" @click="deletOrganizer(scope.$index, scope.row)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
    </el-row>
</el-main>
</template>

<script>
import OrganizerInputForm from "../components/OrganizerInputForm.vue";
import {
    ElButton,
    ElMessage
} from 'element-plus'
export default {
    components: {
        ElButton
    },
    components: {
        OrganizerInputForm
    },

    data() {
        return {
            loading: false,
            events: [],
            organizers: [],
            organizerValue: [],
            eventOrganizer: {
                name: '',
                details: '',
                button: 'Create'

            },
            errorMessage: null,
            showSuccess: '',
            showError: '',
        }
    },

    mounted() {

        this.fetchOrganizerData();
    },
    methods: {
        editCategroy(index, row) {
            this.$router.push({
                path: `/eventOrganizer/${row.term_id}`
            })

        },
        fetchOrganizerData() {

            const that = this;
            jQuery.ajax({
                type: "GET",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_get_organizer_data",
                },
                success: function (data) {
                    that.organizers = data.data;

                }
            });

        },
        onSubmit() {
            console.log("Hello");
            const that = this;

            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_insert_event_organizer_data",
                    name: that.eventOrganizer.name,
                    details: that.eventOrganizer.details,
                    ems_nonce: ajax_url.ems_nonce,
                },
                success: function (data) {
                    ElMessage({
                        showClose: true,
                        message: 'Successfully add category',
                        type: 'success',
                    })

                },
                error: function (error) {
                    ElMessage.error('Oops, error in inserting category.')

                }
            });

        },

        deletOrganizer(index, row) {
            const that = this;
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_delete_organizer",
                    id: row.term_id,
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
                    action: "ems_get_organizer_data",
                },
                success: function (data) {
                    that.organizers = data.data;
                }
            });

        },
    }

}
</script>

<style scoped>
.wrap {
    width: 100%;

}
</style>
