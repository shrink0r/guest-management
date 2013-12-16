/**
 * Access all EventWorkflowItem tickets by identifier.
 */
function(doc)
{
    if (doc.type && 'EventWorkflowItem' === doc.type)
    {
        emit(doc._id, doc.ticket);
    }
}
