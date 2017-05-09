xquery version "1.0";
<query1>
{
    for $var in 
        doc("assignment8.xml")
        //student
    let
        $d := $var/@admissionQ
    where
        contains($d, "Fall")
    order by
        $var/id
    return
        <student>{$var/id, $var/first}</student>
}
</query1>