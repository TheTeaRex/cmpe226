<query3>
{
    for $var in
        doc("assignment8.xml")
        //professor
    let 
        $a := $var/id
    where
        contains($a, "012485")
    return
        <person>{$var/id, $var/first}</person>
}
</query3>