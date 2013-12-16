<?php

class Guestlist_Export_ExportSuccessView extends GuestlistBaseView
{
    public function executeConsole(\AgaviRequestDataHolder $request_data)
    {
        return "Finished exporting Guestlist documents." . PHP_EOL;
    }
}
