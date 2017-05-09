<query7>
{
    for $cla in
        doc("assignment8.xml")
        //class
    for $per in
        doc("assignment8-2.xml")
        //person
    let
        $a := $cla/professor/id,
        $b := $per/id
    where
        $a = $b
    return
        <person>{$cla/professor/first, $cla/professor/last, $per/phone}</person>
}
</query7>