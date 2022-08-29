(function ($) {
    "use strict";
    $(document).ready(function () {
        var events = [];

        $.ajax({
            type: "GET",
            url: ajax_url.ajaxurl,
            dataType: "json",
            data: {
                action: "ems_get_event_data",
            },
            success: function (data) {
                events =  data.data;
                renderEventCards(events);

            },
            error: function (error) {},
        });

        function renderEventCards(events)
        {
            var html = '';
            $(".card-content").html('');
            var url = window.location.href;
            
            $.each(events, function (index, value) {

                var Id = value.ID;
                var title = value.post_title;
                var content = JSON.parse(value.post_content);
               
                html += `<div class="col-sm-4">`;
                html += `<div class="card">`;
                html += `<div class="card-image"><img class="" src="${content.url}" alt=""></div>`;
                html += `<div class="card-body card-info">`;
                html += `<div class="card-text event_id">${Id}</div>`;
                html += `<div class="card-text event_title"><b>Title:</b> ${title}</div>`;
                html += `<div class="card-text event_category"><b>Category:</b> ${content.category}</div>`;
                html += `<div><button type="button" class="btn btn-primary viewEvent">View</button></div>`
                html += `<div><button type="button" class="btn btn-primary registerEvent">Register</button></div>`

                html += `</div>`;
                html += `</div>`;
                html += `</div>`;
            });
            $(".row").append(html);
        }
        
        //View Event
        $(document).on("click",".viewEvent",function()
        {
            var id = $(this).closest('.card').find('.event_id').text();
            var singleEvent = {};
            
            const that = this;
            $.ajax({
                
            type: "GET",
            url: ajax_url.ajaxurl,
            dataType: "json",
            data: {
                action: "ems_get_single_event_data",
                id: id
            },
            success: function (data) {
                that.singleEvent =  data.data;
                var value = JSON.parse(that.singleEvent.eventData);
                var html = '';

                html += `<div>`;
                html += `<div class="image"><img src="${value.url}" alt=""></div>`;
                html += `<div>`;
                html += `<div>ID:${id}</div>`;
                html += `<div>Title:${value.title}</div>`;
                html += `<div>Category:${value.category}</div>`;
                html += `<div>Details:${value.details}</div>`;
                html += `<div>Starting Date:${value.startingDate}</div>`;
                html += `<div>Starting Time:${value.startingTime}</div>`;
                html += `<div>Ending Date:${value.endingDate}</div>`;
                html += `<div>Ending Time:${value.endingTime}</div>`;
                html += `<div>Organizer:${value.organizer}</div>`;
                html += `<div>Limit:${value.limit}</div>`;
                html += `<div>Location:${value.location}</div>`;
                html += `<div>Online Event:${value.onlineEvent}</div>`;

                html += `</div>`;
                html += `</div>`;
                $("#getCodeModal").modal("show");
                $("#getCode").html(html).show();

            },
            error: function (error) {},
        });

        //Register Event
        $(document).on("click",".registerEvent",function()
        {
            var eventId = $(this).closest('.card').find('.event_id').text();
            var eventTitle = $(this).closest('.card').find('.event_title').text();

            $("#exampleModal").modal("show");
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                let name = $('input[name="name"]').val();
                let email = $('input[name="email"]').val();
                          
                $.ajax({
                    type: "POST",
                    url: ajax_url.ajaxurl,
                    dataType: "json",
                    data: {
                        action: "ems_insert_registration_data",
                        eventId: eventId,
                        eventTitle: eventTitle,
                        name: name,
                        email: email,
                        ems_nonce: ajax_url.ems_nonce,
                    },
                    success: function(data) {
                        alert(data.data.message);
                    },
                    error: function (error) {
                        alert(error.responseJSON.data);
                    }
                });
            });
            
        });

    });

    });
    
})(jQuery);