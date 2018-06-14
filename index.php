<!DOCTYPE HTML>
<html>
    <head>
        <title>Ancestree</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>

        <!-- Redirect to adding a person form-->
        <form action = "insertPerson.php">
            <input type = "submit" value = "Add Person">
        </form>
        <form action = "openTree.php">
            <input type = "submit" value = "Open Tree">
        </form>
        <form action = "createPDF.php">
            <input type = "submit" value = "Build PDF">
        </form>
        <!-- Reorder is only used for reordering the input file -->
        <!-- <form action = "reorder.php">
            <input type = "submit" value = "Reorder">
        </form> -->

        <!-- This is to create the person when the user clicks submit on the sign up page  -->
        <?php
            //Add the person to the csv file.
            if ($_POST["clicked"] == "Submit") {
                $newPerson = array($_POST["code"], $_POST["firstName"], $_POST["midName"], $_POST["lastName"], $_POST["description"], $_POST["dob"], $_POST["dobLocation"]);
                $histFile = fopen("testfile.txt", "a");
                fputcsv($histFile, $newPerson);
                fclose($histFile);
            }
            ?>


        <!-- Need to display current tree -->

    </body>
</html>
