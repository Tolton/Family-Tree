<?php
    session_start();
    include("tree.php");
    include("person.php");
    
    
    
    $histFile = fopen("testfile.txt", "r");
    
    $buildTree = new Tree();
    $treeArray = array();
    $treeArray[0] = array();
    $treeArray[1] = array();
    $gen1Names = array();
    while(! feof($histFile)) {
        $toAddNode = fgetcsv($histFile);
        
        
        if (count($toAddNode) == 1) {
            break;
        }
        $newPerson = new Person($toAddNode[0], $toAddNode[1], $toAddNode[2], $toAddNode[3], $toAddNode[4], $toAddNode[5], $toAddNode[6], $toAddNode[7]);
        $buildTree->insert($newPerson);
        array_push($treeArray[0], $toAddNode[7]);
        array_push($treeArray[1], $newPerson->printText());
        if (strlen($toAddNode[0]) == 1) {
            array_push($gen1Names, "#H".$toAddNode[0]."  ".$toAddNode[1]." ".$toAddNode[2]);
        }
        
    }
    
    fclose($histFile);
    $_SESSION['tree'] = $buildTree;
    $_SESSION['gen1'] = $gen1Names;
    $_SESSION['array'] = $treeArray;
    ?>
