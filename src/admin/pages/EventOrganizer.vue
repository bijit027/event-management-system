<template>
<el-main>
    <el-button type="primary" @click="addOrganizeer()">Add Organizer</el-button>

    <el-table :data="displayData" style="width: 100%">
        <el-table-column label="ID" prop="term_id" />
        <el-table-column label="Name" prop="name" />
        <el-table-column align="right">
            <template #default="scope">
                <el-button size="small" @click="editOrganizer(scope.$index, scope.row)">Edit</el-button>
                <el-button size="small" type="danger" @click="deletOrganizer(scope.$index, scope.row)">Delete</el-button>
            </template>
        </el-table-column>
    </el-table>
    <el-row>
    <div class="pagination-block">
        <el-pagination background layout="sizes,total,prev, pager, next,jumper" @current-change="handleCurrentChange" @size-change="handleSizeChange" :page-size="pageSize" :page-sizes="[5,10,15,20]" :total="organizers.length" />
    </div>
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
            page: 1,
            pageSize: 5
        }
    },

    mounted() {

        this.fetchOrganizerData();
    },
    computed: {
        displayData() {
            if (!this.organizers || this.organizers.length === 0) return [];
            return this.organizers.slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
        }
    },
    methods: {
        addOrganizeer() {
            this.$router.push({
                path: `/addEventOrganizer`
            })
        },
        handleCurrentChange(val) {
            this.page = val;
        },
        handleSizeChange(val) {
            this.pageSize = val;
        },
        editOrganizer(index, row) {
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
                        message: data.data.message,
                        type: 'success',
                    })

                },
                error: function (error) {
                    ElMessage.error(error.responseJSON.data.error)

                },
            });
        },
    }
}
</script>

<style>
.wrap {
    width: 100%;
}
.pagination-block{
    margin-left:auto;
    margin-right: 0px;
}

</style>
