<?php

/**
 * @copyright       BerlinOnline Stadtportal GmbH & Co. KG
 * @package         Event
 * @subpackage      Guestlists
 */
class Event_Guestlists_GuestlistsErrorView extends EventBaseView
{
    public function executeHtml(\AgaviRequestDataHolder $request_data)
    {
        $this->setupHtml($request_data);
    }
}
