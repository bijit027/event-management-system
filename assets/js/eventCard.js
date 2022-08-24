(function ($) {
    "use strict";
    $(document).ready(function () {
        // var contactData = "";
        // var settingsData = "";

        var events = [];
        // const that = this;
        $.ajax({
            type: "GET",
            url: ajax_url.ajaxurl,
            dataType: "json",
            data: {
                action: "ems_get_event_data",
            },
            success: function (data) {
                events =   JSON.stringify(data.data);
                console.log(events);
                // events = data.data;
                // renderEventCard(events);
                // // console.log(events);

                // events.forEach(function (ele) {
                //     let card=$($('#container').html());
                //     card.find('.title').text(ele.post_title);
                //     let cards=$($('#container').html());

                // }
                
                // );

                $.each(events, function (index, item) {
                    var userId = item.ID;
                    var typeId = item.ID;
                    var titleId = item.post_title;
                    var bodyId = item.body;
                    var $info = $("<p/>").html("user id: " + userId + "<br>"
                        + "id: " + typeId + "<br>"
                        + "title: " + titleId + "<br>"
                        + "body: " + bodyId);

                    var html = '<div id="card-body>';

                //     for (let i = 0; i < $(result).length; i++) {
                //         const element = $(result)[i];
                //     }

                //         html += '</div>';

                //         $(".addDiv").append(html);

                //     $("div#card-body").append($info);
                });

            },
            error: function (error) {},
        });

        // function renderEventCard(events){
        //     $.each(events, function (key, value) {

        //         $( "#container" ).append( post_title );


        // }



       
    });
})(jQuery);