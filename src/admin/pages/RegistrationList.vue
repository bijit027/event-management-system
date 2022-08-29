<template>
<el-main>
    <div>
        <h2>Registry List</h2>
    </div>
    <el-table :data="displayData" style="width: 100%">
        <el-table-column label="ID" prop="ID" />
        <el-table-column label="Applicant" prop="post_title" />
        <el-table-column align="right">
            <template #default="scope">
                <el-button size="small" type="primary" @click="showSingleData(scope.$index, scope.row)">View</el-button>
                <el-button size="small" type="danger" @click="cancelRegistration(scope.$index, scope.row)">cancel</el-button>
            </template>
        </el-table-column>
    </el-table>

    <el-row>
        <div class="pagination-block">
            <el-pagination background layout="sizes,total,prev, pager, next,jumper" @current-change="handleCurrentChange" @size-change="handleSizeChange" :page-size="pageSize" :page-sizes="[5,10,15,20]" :total="registration.length" />
        </div>
    </el-row>
</el-main>
</template>

<script>
import CategoryInputForm from "../components/CategoryInputForm.vue";
import {
    ElButton,
    ElMessage
} from 'element-plus'
export default {
    components: {
        ElButton
    },
    components: {
        CategoryInputForm
    },

    data() {
        return {
            loading: false,
            events: [],
            registration: [],
            eventCategory: {
                title: '',
                button: 'Create'
            },
            errorMessage: null,
            showSuccess: '',
            showError: '',
            page: 1,
            pageSize: 5
        }
    },

    mounted() {
        this.fetchData();
    },
    computed: {
        displayData() {
            if (!this.registration || this.registration.length === 0) return [];
            return this.registration.slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
        }
    },
    methods: {
        showSingleData(index, row) {
            this.$router.push({
                path: `/registrationList/${row.ID}`
            })},

                handleCurrentChange(val) {
                    this.page = val;
                },
                handleSizeChange(val) {
                    this.pageSize = val;
                },

                cancelRegistration(index, row) {
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
                                message: data.data.message,
                                type: 'success',
                            })

                        },
                        error: function (error) {
                            ElMessage.error(error.responseJSON.data.error)

                        },
                    });
                },
                fetchData() {
                    const that = this;
                    jQuery.ajax({
                        type: "GET",
                        url: ajax_url.ajaxurl,
                        dataType: 'json',
                        data: {
                            action: "ems_get_event_registration_data",
                        },
                        success: function (data) {
                            that.registration = data.data;
                        }
                    });

                },
        }

    
}
</script>

<style>

</style>
