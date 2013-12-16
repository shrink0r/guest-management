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

        // initially setup the fracs-section dom and options
        var $fracs = $('<div class="fracs-container"><span class="hb-icon-map open-fracs"></span><ul class="fracs-list"></ul></div>');
        var $fracs_list = $fracs.find('.fracs-list');
        $(document.body).append($fracs);
        // register event handler for showing and hiding the fracs-panel
        var visible = false;
        var locked = false;
        $fracs.find('.open-fracs').click(function()
        {
            if (true === visible)
            {
                $fracs.removeClass('open');
            }
            else
            {
                $fracs.addClass('open');
            }
            visible = !visible;
        });
        // refresh fracs-section when an aggregate has been deleted
        var i = 0;
        var aggregate_widget = null;
        for (; i < controller.widgets.length; i++)
        {
            if (controller.widgets[i] instanceof honeybee.widgets.Aggregate)
            {
                aggregate_widget = controller.widgets[i];
                break;
            }
        }
        var s4 = function()
        {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        };
        var uid = function()
        {
            return s4() + s4();
        }
        // initially render fracs list
        var aggregate_map = {};
        var item_tpl = '<li>'+
            '<b class="index-text">#{INDEX}</b><span class="aggregate-label"> {LABEL}</span>' +
            '<div class="action-overlay"><span class="hb-icon-remove remove-action"></span></div>' +
            '<ul class="aggregate-actions">' +
                '<li class="fade-out"></li>' +
                '<li class="action-up"><span class="hb-icon-arrow-up-2"></span></li>' +
                '<li class="action-down"><span class="hb-icon-arrow-down-2"></span></li>' +
            '</ul>'+
        '</li>';
        var createFracsItem = function(index, label, uid, aggregate)
        {
            var markup = item_tpl.replace('{INDEX}', index).replace('{LABEL}', label);
            var $fracs_item = $(markup);
            $fracs_item[0].uid = uid;
            aggregate_map[uid] = {
                fracs: $fracs_item,
                aggregate: aggregate
            };
            $fracs_item.find('.action-up').click(function()
            {
                aggregate_widget.moveItemUp(
                    aggregate_map[$fracs_item[0].uid].aggregate
                );
                return false;
            });
            $fracs_item.find('.action-down').click(function()
            {
                aggregate_widget.moveItemDown(
                    aggregate_map[$fracs_item[0].uid].aggregate
                );
                return false;
            });
            $fracs_item.find('.remove-action').click(function()
            {
                aggregate_widget.removeItem(
                    aggregate_map[$fracs_item[0].uid].aggregate
                );
                return false;
            });
            $fracs_item.click(function()
            {
                var item = aggregate_map[$fracs_item[0].uid].aggregate;
                item.removeClass('collapsed');
                var first_input = item.find('input').first();
                $('html, body').animate({scrollTop: first_input.offset().top - 200}, 350, function()
                {
                    first_input.focus();
                });
            });
            return $fracs_item;
        };
        var updateFracsIndexes = function()
        {
            $fracs_list.find('> li').each(function(idx, fracs_item)
            {
                $(fracs_item).find('.index-text').text('#' + (idx + 1));
            });
        };
        aggregate_widget.element.find('.aggregate').each(function(idx, item)
        {
            item.uid = uid();
            var label = $(item).find('h3 .displayed_text').text();
            $fracs_list.append(
                createFracsItem(idx + 1, label, item.uid, $(item))
            );
        });
        // register aggregate widget events
        aggregate_widget.on('aggregate-label-changed', function(event)
        {
            var item = event.element[0];
            if (aggregate_map[item.uid])
            {
                aggregate_map[item.uid].fracs.find('.aggregate-label').text(
                    event.element.find('h3 .displayed_text').text()
                );
            }
        }).on('aggregate-added', function(event)
        {
            var aggregate_item = event.element[0];
            aggregate_item.uid = uid();
            var label = event.element.find('h3 .displayed_text').text();
            $fracs_list.append(
                createFracsItem($fracs_list.find('> li').length + 1, label, aggregate_item.uid, event.element)
            );
        }).on('aggregate-removed', function(event)
        {
            var $fracs_item = aggregate_map[event.element.uid].fracs;
            delete aggregate_map[event.element.uid];
            $fracs_item.remove();
            updateFracsIndexes();
        }).on('aggregate-moved-up', function(event)
        {
            var $fracs_item = aggregate_map[event.element[0].uid].fracs;
            $fracs_item.insertBefore($fracs_item.prev());
            updateFracsIndexes();
        }).on('aggregate-moved-down', function(event)
        {
            var $fracs_item = aggregate_map[event.element[0].uid].fracs;
            $fracs_item.insertAfter($fracs_item.next());
            updateFracsIndexes();
        });


        var messageEventHandler = function(event)
        {
            var msg_data = JSON.parse(event.data);
            console.log(msg_data);
        }

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
