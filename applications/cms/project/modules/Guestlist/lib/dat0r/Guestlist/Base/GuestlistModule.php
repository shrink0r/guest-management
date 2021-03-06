<?php
/*              AUTOGENERATED CODE - DO NOT EDIT !
This base class was generated by the Dat0r library (https://github.com/berlinonline/Dat0r)
on 2013-12-16 23:28:11 and is closed to modifications by any meaning.
If you are looking for a place to alter the behaviour of the 'Guestlist' module,
then the 'GuestlistModule' (skeleton) class probally might be a good place to look. */

namespace Honeybee\Domain\Guestlist\Base;

use Dat0r\Core\Field\AggregateField;
use Dat0r\Core\Field\KeyValueField;
use Dat0r\Core\Field\TextField;
use Dat0r\Core\Field\TextareaField;
use Honeybee\Core\Dat0r;

/**
 * Serves as the base class to the 'Guestlist'' module skeleton.
 */
abstract class GuestlistModule extends Dat0r\Module
{
    /**
     * Creates a new GuestlistModule instance.
     */
    protected function __construct()
    {
        parent::__construct(
            'Guestlist',
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
                AggregateField::create(
                    'invitations',
                    array(
                        'modules' => array(
                            '\\Honeybee\\Domain\\Guestlist\\InvitationModule',
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
                            '\\Honeybee\\Domain\\Guestlist\\WorkflowTicketModule',
                        ),
                    )
                ),
            ),
            array(
                'prefix' => 'guestlist',
                'identifier_field' => 'identifier',
                'slugPattern' => 'guestlist-{shortId}',
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
        return '\\Honeybee\\Domain\\Guestlist\\GuestlistDocument';
    }
}
