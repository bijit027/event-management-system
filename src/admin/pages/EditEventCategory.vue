<template>
<div class="wrap">
    <el-card class="box-card">
        <CategoryInputForm v-bind:eventCategory="value" @form-submit="onSubmit" />
    </el-card>
</div>
</template>

<script>
import {
    ElButton,
    ElMessage
} from 'element-plus';
import CategoryInputForm from "../components/CategoryInputForm.vue";
export default {

    data() {
        return {
            eventCategoryID: this.$route.params.eventID,
            eventCategory: {},
            value: {
                title: '',
                button: '',
            },
        }
    },
    components: {
        CategoryInputForm
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
                    action: "ems_get_single_category_data",
                    id: that.eventCategoryID
                },
                success: function (data) {
                    that.eventCategory = data.data;
                    
                    that.value.title = that.eventCategory.name;
                    console.log(that.eventCategory.name);
                    that.value.button = 'Update';

                }
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
                    id: that.eventCategoryID,
                    title: that.value.title,
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
    }

}
</script>

<style scoped>
.wrap {
    width: 60%;
    margin: auto;
    margin-top: 50px;
}
</style>
