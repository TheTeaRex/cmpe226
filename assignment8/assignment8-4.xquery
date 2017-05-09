<query4>
{
    for $var in
        doc("assignment8.xml")
        //class
    let
        $a := $var/@id
    where
        $a = "226"
    return
        <person>{$var//first}</person>
}
</query4>