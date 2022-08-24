<template>
<InputForm v-bind:event="event" v-bind:errors="errors" @form-submit="onSubmit" />
</template>

<script>
import {
    ElButton,
    ElMessage
} from 'element-plus';
import InputForm from "../components/InputForm.vue";
export default {

    data: function () {
        return {
            event: {
                title: '',
                details: '',
                category: '',
                organizer: '',
                onlineEvent: '',
                url: '',
                startingDate: '',
                startingTime: '',
                endingDate: '',
                endingTime: '',
                limit: '',
                deadline: '',
                button: 'Create',
            },

            showSuccess: '',
            showError: '',
            errors: [],
        }
    },
    components: {
        InputForm
    },

    methods: {
        onSubmit() {
            const that = this;
            jQuery.ajax({
                type: "POST",
                url: ajax_url.ajaxurl,
                dataType: 'json',
                data: {
                    action: "ems_insert_event_data",
                    title: that.event.title,
                    details: that.event.details,
                    category: that.event.category,
                    organizer: that.event.organizer,
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
                    ElMessage({
                        showClose: true,
                        message: data.data.message,
                        type: 'success',
                    })
                },
                error: function (error) {
                    that.errors = error.responseJSON.data;
                    if (error.responseJSON.data.error) {
                        ElMessage.error(error.responseJSON.data.error)
                    }
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
