<?php

class Guest_Export_ExportSuccessView extends GuestBaseView
{
    public function executeConsole(\AgaviRequestDataHolder $request_data)
    {
        return "Finished exporting Guest documents." . PHP_EOL;
    }
}
