<html>
<body>
<div>
<?php
    
    include("tree.php");
    include("person.php");
    
    $histFile = fopen("testfile.txt", "r");
    
    $buildTree = new Tree();
    while(! feof($histFile))
    {
        $toAddNode = fgetcsv($histFile);
        
        
        if (count($toAddNode) == 1) {
            break;
        }
        $newPerson = new Person($toAddNode[0], $toAddNode[1], $toAddNode[2], $toAddNode[3], $toAddNode[4], $toAddNode[5], $toAddNode[6]);
        $buildTree->insert($newPerson);
    }
    
    fclose($histFile);
    $buildTree->printAll();
?>
</div>

</body>
</html>
