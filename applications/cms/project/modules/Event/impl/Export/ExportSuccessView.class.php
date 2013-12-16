<?php

class Event_Export_ExportSuccessView extends EventBaseView
{
    public function executeConsole(\AgaviRequestDataHolder $request_data)
    {
        return "Finished exporting Event documents." . PHP_EOL;
    }
}
