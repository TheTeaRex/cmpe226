<query6>
{
    for $stu in
        doc("assignment8.xml")
        //student
    for $per in
        doc("assignment8-2.xml")
        //person
    let
        $a := $stu/id,
        $b := $per/id
    where
        $a = $b
    return
        <person>{$stu/first, $per/phone}</person>
}
</query6>