<template>
<el-main>
    <div>
        <h2>ALL Events</h2>
    </div>
    <el-button type="primary" @click="addCategory()">Add Category</el-button>

    <el-table :data="displayData" style="width: 100%">
        <el-table-column label="Term ID" prop="term_id" />
        <el-table-column label="Category" prop="name" />
        <el-table-column align="right">
            <template #default="scope">
                <el-button size="small" @click="editCategroy(scope.$index, scope.row)">Edit</el-button>
                <el-button size="small" type="danger" @click="deletCategory(scope.$index, scope.row)">Delete</el-button>
            </template>
        </el-table-column>
    </el-table>

    <el-row>
        <div class="pagination-block">
            <el-pagination background layout="sizes,total,prev, pager, next,jumper" @current-change="handleCurrentChange" @size-change="handleSizeChange" :page-size="pageSize" :page-sizes="[5,10,15,20]" :total="category.length" />
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
            category: [],
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
            if (!this.category || this.category.length === 0) return [];
            return this.category.slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
        }
    },
    methods: {
        addCategory() {
            this.$router.push({
                path: `/addEventCategory`
            })
        },
        handleCurrentChange(val) {
            this.page = val;
        },
        handleSizeChange(val) {
            this.pageSize = val;
        },

        editCategroy(index, row) {
            this.$router.push({
                path: `/eventCategory/${row.term_id}`
            })
        },

        deletCategory(index, row) {
            const that = this;
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_delete_category",
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
        fetchData() {
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
    }

}
</script>

<style>

</style>
