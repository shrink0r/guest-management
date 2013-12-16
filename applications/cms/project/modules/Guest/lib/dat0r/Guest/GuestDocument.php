<?php
/*                  AUTOGENERATED SKELETON CLASS
This skeleton class was generated by the Dat0r library (https://github.com/berlinonline/Dat0r)
on 2013-12-16 22:18:37 and allows to alter the behaviour of 'Guest' documents.
This file is only generated if doesn't exist so eventual modifications are safe. */

namespace Honeybee\Domain\Guest;

use Honeybee\Domain\Guest\Base;

/**
 * Holds the structure definition for Guest documents.
 */
class GuestDocument extends Base\GuestDocument
{
    public function onBeforeWrite()
    {
        $changed_fields = array();
        foreach ($this->getChanges() as $change) {
            $changed_fields[] = $change->getField()->getName();
        }

        if (in_array('firstname', $changed_fields) || in_array('lastname', $changed_fields)) {
            $this->setFullname($this->getFirstname() . ' ' . $this->getLastname());
        }

        parent::onBeforeWrite();
    }
}
