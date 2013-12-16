/**
 * Access all GuestWorkflowItem tickets by identifier.
 */
function(doc)
{
    if (doc.type && 'GuestWorkflowItem' === doc.type)
    {
        emit(doc._id, doc.ticket);
    }
}
