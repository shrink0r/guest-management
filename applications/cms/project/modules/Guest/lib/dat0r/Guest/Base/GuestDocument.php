<?php
/*              AUTOGENERATED CODE - DO NOT EDIT !
This base class was generated by the Dat0r library (https://github.com/berlinonline/Dat0r)
on 2013-12-16 23:37:22 and is closed to modifications by any meaning.
If you are looking for a place to alter the behaviour of 'Guest' documents,
then the 'GuestDocument' (skeleton) class probally might be a good place to look. */

namespace Honeybee\Domain\Guest\Base;

use Honeybee\Core\Dat0r;

/**
 * Serves as the base class to the 'Guest' document skeleton.
 */
abstract class GuestDocument extends Dat0r\Document
{
    /**
     * Returns an 'Guest' document's firstname.
     *
     * @return 
     */
    public function getFirstname()
    {
        return $this->getValue('firstname');
    }

    /**
     * Sets an 'Guest' document's firstname.
     *
     * @param  $firstname
     */
    public function setFirstname($firstname)
    {
        $this->setValue('firstname', $firstname);
    }

    /**
     * Returns an 'Guest' document's lastname.
     *
     * @return 
     */
    public function getLastname()
    {
        return $this->getValue('lastname');
    }

    /**
     * Sets an 'Guest' document's lastname.
     *
     * @param  $lastname
     */
    public function setLastname($lastname)
    {
        $this->setValue('lastname', $lastname);
    }

    /**
     * Returns an 'Guest' document's fullname.
     *
     * @return 
     */
    public function getFullname()
    {
        return $this->getValue('fullname');
    }

    /**
     * Sets an 'Guest' document's fullname.
     *
     * @param  $fullname
     */
    public function setFullname($fullname)
    {
        $this->setValue('fullname', $fullname);
    }

    /**
     * Returns an 'Guest' document's meta.
     *
     * @return 
     */
    public function getMeta()
    {
        return $this->getValue('meta');
    }

    /**
     * Sets an 'Guest' document's meta.
     *
     * @param  $meta
     */
    public function setMeta($meta)
    {
        $this->setValue('meta', $meta);
    }

    /**
     * Returns an 'Guest' document's workflowTicket.
     *
     * @return 
     */
    public function getWorkflowTicket()
    {
        return $this->getValue('workflowTicket');
    }

    /**
     * Sets an 'Guest' document's workflowTicket.
     *
     * @param  $workflowTicket
     */
    public function setWorkflowTicket($workflowTicket)
    {
        $this->setValue('workflowTicket', $workflowTicket);
    }
}
