<html>

<head>
    <title>Meeting Setup</title>
</head>

<body>
    <form action="meeting.php" method="post" name="meeting"> Time Slots:
        <br>
        <br>
        <?php

        $date = new DateTime('8:30');
        $date->add(new DateInterval('PT30M'));
        echo $date;
        
        
        
        ?>
            <input type="checkbox" name="timeSlots" value="8"> 8:00 - 8:30
            <select name="sessionType">
                <option value="Individual">I</option>
                <option value="Group">G</option>
            </select>
            <br>
            <br>
            <input type="submit" name="submit" value="Submit"> </form>
</body>

</html>