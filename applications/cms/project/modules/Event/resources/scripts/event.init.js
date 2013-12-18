(function(namespace)
{
    var initStickyControls = function()
    {
        var form_actions = $('.controller-edit .form-actions');
        var footer = $('.footer');
        var actions_height = form_actions.height();
        var documentHeight = $(document).height();

        var stick = function()
        {
            var max_bottom = footer.offset().top;
            var pos = form_actions.offset();
            var bottom = pos.top + actions_height;
            var viewport_edge = $(document).scrollTop() + $(window).height();
            var diff = viewport_edge - max_bottom;

            if (diff >= 0)
            {
                form_actions.removeClass('overlayed');
                form_actions.css('bottom', diff - footer.height() + 3);
            }
            else
            {
                form_actions.addClass('overlayed');
                form_actions.css('bottom', '-20px');
            }
        };

        $(document).scroll(function()
        {
            stick();
        });

        $('a[data-toggle="tab"]').on('shown', function(e)
        {
            stick();
        });

        stick();
    };

    var edit_wrapper = $('.controller-edit');
    var list_wrapper = $('.container-list-data');
    var tree_wrapper = $('.container-tree-data');
    var event_fe_container = $('.event-app-container');

    if (1 === edit_wrapper.length)
    {
        honeybee.core.EditController.factory('.controller-edit');
        initStickyControls();
    }
    else if (1 === list_wrapper.length)
    {
        honeybee.list.ListController.create('.container-list-data', namespace).attach();
    }
    else if (1 === tree_wrapper.length)
    {
        honeybee.tree.TreeController.create('.container-tree-data', namespace).attach();
    }
    else if(1 === event_fe_container.length)
    {
        $('.event-selector').select2();
        $('.event-selector').change(function()
        {
            var val = $(this).val().trim();
            if (val.length > 0) {
                $('#'+val).show();
            } else {
                $('.events-list .event').hide();
            }
        });
        var app_container = $('.event-app-container');
        $('#guest-selector').select2();
        $('#guest-selector').on('change', function()
        {
            var json_data = $(this).val().trim();
            var relation_graph = false;
            var event = false;
            var guestlist = false;
            if (json_data.length > 0) {
                relation_graph = JSON.parse(json_data);
            }
            if (relation_graph) {
                event = $('#'+relation_graph.event);
                guestlist = $('#'+relation_graph.guest_list);
                event.find('.guestlist').each(function(idx, cur_guestlist)
                {
                    cur_guestlist = $(cur_guestlist);
                    if (cur_guestlist.attr('id') == relation_graph.guest_list) {
                        cur_guestlist.show();
                    } else {
                        cur_guestlist.hide();
                    }
                });
                guestlist.find('.guest').each(function(idx, guest)
                {
                    guest = $(guest);
                    if (guest.attr('id') != relation_graph.guest) {
                        guest.addClass('step-back');
                    } else {
                        guest.removeClass('step-back');
                    }
                });
            } else {
                $('.guestlist').each(function(idx, cur_guestlist)
                {
                    $(cur_guestlist).show();
                });
                $('.guest').each(function(idx, guest)
                {
                    $(guest).removeClass('step-back');
                });
            }
        });

        $('.guests-list .guest').each(function(idx, guest_item)
        {
            guest_item = $(guest_item);
            guest_item.find('.trigger-checkin').click(function()
            {
                var trigger = $(this);
                trigger.removeClass('label-default').addClass('label-success').text('Eingecheckt!');
                guest_item.addClass('checked-in');
                var decrement_trigger = trigger.siblings('.trigger-decrement-xguests');
                var count_el = decrement_trigger.first().find('.count');
                var count = parseInt(count_el.text());
                if (count == 0) {
                    guest_item.addClass('completed');
                }
            });
            guest_item.find('.trigger-decrement-xguests').click(function()
            {
                var trigger = $(this);
                var count_el = trigger.find('.count');
                var count = parseInt(count_el.text());
                if (count == 0) {
                    return;
                }
                count--;
                count_el.text(count);
                if (count == 0) {
                    trigger.removeClass('label-warning').addClass('label-success');
                    if (guest_item.hasClass('checked-in')) {
                        guest_item.addClass('completed');
                    }
                }
            });
        });

        $('.toggle-description').click(function()
        {
            var toggle = $(this);
            var desc = toggle.next('.description');
            if (desc.hasClass('reveal')) {
                desc.removeClass('reveal');
            } else {
                desc.addClass('reveal');
            }
        });
        // setup parallax scrolling 
        var $window = $(window);
        var scrollable_bg_range = app_container.height() - 1333; // bg-img height
        $window.scroll(function() {
            var offset_ratio = (100 / app_container.height()) * $window.scrollTop();
            var bg_scroll_offset = (scrollable_bg_range / 100) * offset_ratio;
            app_container.css('background-position-y', -bg_scroll_offset);
        });
    }
})(honeybee.event);
