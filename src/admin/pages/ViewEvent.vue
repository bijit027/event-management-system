<template>
    <div>
        {{ events}}
        

    </div>
</template>

<script>
    export default {
            data() {
        return {
            eventID: this.$route.params.eventID,
            events: [],
            val:[]
        }
         },
             mounted() {
        this.fetchData();   
    },

            methods: {
        fetchData(){
            const that = this;
            jQuery.ajax({
            type: "GET",
            url: ajax_url.ajaxurl,
            dataType: 'json',
            data: {
                action: "ems_get_single_event_data",
                id: that.eventID
            },
            success: function (data) {
                that.events = data.data;
                // that.val = that.events.title;
                // console.log(that.events);
            }
        });

        }
    }
   
        
    }
</script>

<style scoped>

</style>