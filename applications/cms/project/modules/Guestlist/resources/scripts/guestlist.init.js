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

    if (1 === edit_wrapper.length)
    {
        var controller = honeybee.core.EditController.factory('.controller-edit');
        initStickyControls();

        var messageEventHandler = function(event)
        {
            var msg_data = JSON.parse(event.data);
            if (msg_data.field_id) {
                var parent_aggregate = $('#' + msg_data.field_id).parents('.aggregate');
                if (parent_aggregate.length > 0) {
                    var label = parent_aggregate.find('.pill-container .tagslist-tag span').first();
                    var label_text = 'Kein Gast zugewiesen';
                    if (label) {
                        label_text = label.text();
                    }
                    parent_aggregate.find('.input-group-label .displayed_text').text(label_text);
                }
            }
        };
        window.addEventListener('message', messageEventHandler,false);
    }
    else if (1 === list_wrapper.length)
    {
        honeybee.list.ListController.create('.container-list-data', namespace).attach();
    }
    else if (1 === tree_wrapper.length)
    {
        honeybee.tree.TreeController.create('.container-tree-data', namespace).attach();
    }
})(honeybee.guestlist);
