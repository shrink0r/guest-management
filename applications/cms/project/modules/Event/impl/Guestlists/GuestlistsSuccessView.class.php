<?php

class Event_Guestlists_GuestlistsSuccessView extends EventBaseView
{
    public function executeHtml(\AgaviRequestDataHolder $request_data)
    {
        $this->setupHtml($request_data);

        $this->getContext()->getUser()->setAttribute('breadcrumbs', array(), 'honeybee.breadcrumbs');
    }
}
