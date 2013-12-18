<?php
/*              AUTOGENERATED CODE - DO NOT EDIT !
This base class was generated by the Dat0r library (https://github.com/berlinonline/Dat0r)
on 2013-12-17 18:23:26 and is closed to modifications by any meaning.
If you are looking for a place to alter the behaviour of the 'Event' module,
then the 'EventModule' (skeleton) class probally might be a good place to look. */

namespace Honeybee\Domain\Event\Base;

use Dat0r\Core\Field\AggregateField;
use Dat0r\Core\Field\KeyValueField;
use Dat0r\Core\Field\ReferenceField;
use Dat0r\Core\Field\TextField;
use Dat0r\Core\Field\TextareaField;
use Honeybee\Core\Dat0r;

/**
 * Serves as the base class to the 'Event'' module skeleton.
 */
abstract class EventModule extends Dat0r\Module
{
    /**
     * Creates a new EventModule instance.
     */
    protected function __construct()
    {
        parent::__construct(
            'Event',
            array(
                TextField::create(
                    'title',
                    array(
                        'mandatory' => true,
                    )
                ),
                TextareaField::create(
                    'description',
                    array(
                        'use_markdown' => true,
                    )
                ),
                TextField::create(
                    'date',
                    array()
                ),
                ReferenceField::create(
                    'guest_lists',
                    array(
                        'references' => array(
                            array(
                                'module' => '\\Honeybee\\Domain\\Guestlist\\GuestlistModule',
                                'identity_field' => 'identifier',
                                'display_field' => 'title',
                            ),
                        ),
                    )
                ),
                ReferenceField::create(
                    'assignee',
                    array(
                        'max' => 1,
                        'references' => array(
                            array(
                                'module' => '\\Honeybee\\Domain\\User\\UserModule',
                                'identity_field' => 'identifier',
                                'display_field' => 'username',
                            ),
                        ),
                    )
                ),
                KeyValueField::create(
                    'meta',
                    array(
                        'constraints' => array(
                            'value_type' => 'dynamic',
                        ),
                    )
                ),
                AggregateField::create(
                    'workflowTicket',
                    array(
                        'modules' => array(
                            '\\Honeybee\\Domain\\Event\\WorkflowTicketModule',
                        ),
                    )
                ),
            ),
            array(
                'prefix' => 'event',
                'identifier_field' => 'identifier',
                'slugPattern' => 'event-{shortId}',
            )
        );
    }

    /**
     * Returns the IDocument implementor to use when creating new documents.
     *
     * @return string Fully qualified name of an IDocument implementation.
     */
    protected function getDocumentImplementor()
    {
        return '\\Honeybee\\Domain\\Event\\EventDocument';
    }
}
