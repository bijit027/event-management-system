<template>
<el-main>
    <div>
        <h2>ALL Events</h2>
   
    </div>
    <div class="wrap">
        <CategoryInputForm v-bind:eventCategory="eventCategory"  @form-submit="onSubmit" />
    </div>

    <el-table :data="category" style="width: 100%">
        <el-table-column label="Term ID" prop="term_id" />
        <el-table-column label="Category" prop="name" />
        <el-table-column align="right">
            <template #default="scope">
                <el-button size="small" @click="editCategroy(scope.$index, scope.row)">Edit</el-button>
                <el-button size="small" type="danger" @click="deletCategory(scope.$index, scope.row)">Delete</el-button>
            </template>
        </el-table-column>
    </el-table>
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
            components:{
        CategoryInputForm
    },

    data() {
        return {
            loading: false,
            events:[],
            category:[],
            eventCategory: {
                title: '',
                button: 'Create'
            },
            errorMessage: null,
            showSuccess: '',
            showError: '',
        }
    },

    mounted() {

        this.fetchData();
    },
    methods: {
        editCategroy(index, row) {
            this.$router.push({
                path: `/eventCategory/${row.term_id}`
            })

        },
        addEvent() {
            this.$router.push({
                path: `/addEvent`
            })
        },
        onSubmit() {

            const that = this;
            console.log(that.eventcategroy);
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_insert_event_category_data",
                    title: that.eventCategory.title,
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

        deletCategory(index, row) {
            const that = this;
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_delete_event",
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

<style scoped>
.wrap {
    width: 60%;
}
</style>
