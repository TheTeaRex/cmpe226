<query2>
{
    for $var in
        doc("assignment8.xml")
        //class
    let 
        $a := $var/@id
    where
        contains($a, "226")
    return
        <person>{$var/professor/first}</person>
}
</query2>