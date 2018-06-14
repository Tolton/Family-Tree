<?php include("buildTree.php"); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Ancestree</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
    <form action = "openTree.php"  method = "get">
        <input type = "hidden" name = "ID" value="<?php echo htmlspecialchars(substr($_GET['ID'], 0, -1));?>"/>
        <input type = "submit" name = "clicked" value = "Home"/>
        <input type = "submit" name = "clicked" value = "Back"/>
    </form>
<?php
    
   // include("buildTree.php");

    $buildTree = $_SESSION['tree'];
    //echo "<pre>";
    //print_r($buildTree);
    //echo "</pre>";
    
    // This code is to change to a different page/view
    if ($_GET["clicked"] == "Home") {
        $buildTree->buildTree();
    } else if ($_GET["clicked"] == "Back") {
        if (isset($_GET['ID'])) {
            $buildTree->buildByID(null, $_GET['ID']);
            
        }
    } else {
        if (isset($_GET['ID'])) {
            $buildTree->buildByID(null, $_GET['ID']);
        } else {
            $buildTree->buildTree();
        }
    }
    //$buildTree->printAll();
    
    
    ?>


    </body>
</html>
