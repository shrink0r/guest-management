/**
 * Access all GuestlistWorkflowItem tickets by identifier.
 */
function(doc)
{
    if (doc.type && 'GuestlistWorkflowItem' === doc.type)
    {
        emit(doc._id, doc.ticket);
    }
}
