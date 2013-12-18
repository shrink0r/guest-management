<?php

use Honeybee\Domain\Event\EventModule;
use Honeybee\Domain\Guestlist\GuestlistModule;

class Event_GuestlistsAction extends EventBaseAction
{
    public function executeRead(\AgaviRequestDataHolder $request_data)
    {
        $user_id = $this->getContext()->getUser()->getAttribute('identifier');

        $event_module = EventModule::getInstance();
        $search_spec = array('filter' => array('assignee.id' => $user_id));
        $events_result = $event_module->getService()->find($search_spec, 0, 100);

        $this->setAttribute('event_data', $this->prepareViewData($events_result['documents']));

        return 'Success';
    }

    protected function prepareViewData($events)
    {
        $data = array();
        foreach ($events as $event) {
            $all_guests = array();
            if (!isset($data[$event->getTitle()])) {
                $cur_data = array(
                    'id' => $event->getIdentifier(),
                    'title' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'guest_lists' => array(),
                    'all_guests' => array()
                );
            }
            $guest_lists = array();
            $guest_list_ids = array();
            foreach ($event->getGuestLists() as $guest_list) {
                $guest_list_ids[] = $guest_list->getIdentifier();
            }
            $guestlist_module = GuestlistModule::getInstance();
            $guestlist_result = $guestlist_module->getService()->getMany($guest_list_ids);
            foreach ($guestlist_result['documents'] as $guestlist) {
                $cur_guestlist = array(
                    'id' => $guestlist->getIdentifier(),
                    'title' => $guestlist->getTitle(),
                    'description' => $guestlist->getDescription()
                );
                $guests = array();
                foreach ($guestlist->getInvitations() as $invitation) {
                    $guest = $invitation->getGuest()->first();
                    $guest_data = array(
                        'id' => $invitation->getGuest()->first()->getIdentifier(),
                        'name' => $invitation->getGuest()->first()->getFullname(),
                        'relation_graph' => array(
                            'event' => $event->getIdentifier(),
                            'guest_list' => $guestlist->getIdentifier(),
                            'guest' => $guest->getIdentifier()
                        ),
                        'plus' => $invitation->getExtraGuests()
                    );
                    $guests[] = $guest_data;
                    if (!isset($all_guests[$guest_data['name']])) {
                        $all_guests[$guest_data['name']] = $guest_data;
                    }
                }
                $cur_guestlist['guests'] = $guests;
                $guest_lists[] = $cur_guestlist;
            }
            $cur_data['guest_lists'] = $guest_lists;
            $cur_data['all_guests'] = $all_guests;
            $data[] = $cur_data;
        }

        return $data;
    }
}
