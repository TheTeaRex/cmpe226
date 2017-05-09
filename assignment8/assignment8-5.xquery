<html>
    <body>
        <ul>
        {
            for $var in
                doc("assignment8.xml")
                /university
            return
                <li>{$var//first}</li>
        }
        </ul>
    </body>
</html>