var idParts = ctx.doc._id.split('-');
var supported_prefixes = ['guestlist', 'tree'];

if (idParts.length > 1 && -1 !== supported_prefixes.indexOf(idParts[0])) 
{
    ctx._type = idParts[0];
} 
else 
{
    ctx.ignore = true;
}
