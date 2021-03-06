<?php
/*              AUTOGENERATED CODE - DO NOT EDIT !
This base class was generated by the Dat0r library (https://github.com/berlinonline/Dat0r)
on 2013-12-17 18:23:26 and is closed to modifications by any meaning.
If you are looking for a place to alter the behaviour of 'Event' documents,
then the 'EventDocument' (skeleton) class probally might be a good place to look. */

namespace Honeybee\Domain\Event\Base;

use Honeybee\Core\Dat0r;

/**
 * Serves as the base class to the 'Event' document skeleton.
 */
abstract class EventDocument extends Dat0r\Document
{
    /**
     * Returns an 'Event' document's title.
     *
     * @return 
     */
    public function getTitle()
    {
        return $this->getValue('title');
    }

    /**
     * Sets an 'Event' document's title.
     *
     * @param  $title
     */
    public function setTitle($title)
    {
        $this->setValue('title', $title);
    }

    /**
     * Returns an 'Event' document's description.
     *
     * @return 
     */
    public function getDescription()
    {
        return $this->getValue('description');
    }

    /**
     * Sets an 'Event' document's description.
     *
     * @param  $description
     */
    public function setDescription($description)
    {
        $this->setValue('description', $description);
    }

    /**
     * Returns an 'Event' document's date.
     *
     * @return 
     */
    public function getDate()
    {
        return $this->getValue('date');
    }

    /**
     * Sets an 'Event' document's date.
     *
     * @param  $date
     */
    public function setDate($date)
    {
        $this->setValue('date', $date);
    }

    /**
     * Returns an 'Event' document's guest_lists.
     *
     * @return 
     */
    public function getGuestLists()
    {
        return $this->getValue('guest_lists');
    }

    /**
     * Sets an 'Event' document's guest_lists.
     *
     * @param  $guest_lists
     */
    public function setGuestLists($guest_lists)
    {
        $this->setValue('guest_lists', $guest_lists);
    }

    /**
     * Returns an 'Event' document's assignee.
     *
     * @return 
     */
    public function getAssignee()
    {
        return $this->getValue('assignee');
    }

    /**
     * Sets an 'Event' document's assignee.
     *
     * @param  $assignee
     */
    public function setAssignee($assignee)
    {
        $this->setValue('assignee', $assignee);
    }

    /**
     * Returns an 'Event' document's meta.
     *
     * @return 
     */
    public function getMeta()
    {
        return $this->getValue('meta');
    }

    /**
     * Sets an 'Event' document's meta.
     *
     * @param  $meta
     */
    public function setMeta($meta)
    {
        $this->setValue('meta', $meta);
    }

    /**
     * Returns an 'Event' document's workflowTicket.
     *
     * @return 
     */
    public function getWorkflowTicket()
    {
        return $this->getValue('workflowTicket');
    }

    /**
     * Sets an 'Event' document's workflowTicket.
     *
     * @param  $workflowTicket
     */
    public function setWorkflowTicket($workflowTicket)
    {
        $this->setValue('workflowTicket', $workflowTicket);
    }
}
