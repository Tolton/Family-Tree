<?php
    $histFile = fopen("testfile.txt", "r");
    $newFile = fopen("newFile.txt", "a");
    while(! feof($histFile))
    {
        
        $toAddNode = fgetcsv($histFile);
        
        $newPerson = array($toAddNode[3], $toAddNode[0], $toAddNode[1], $toAddNode[2],  $toAddNode[4], $toAddNode[5], $toAddNode[6]);
        fputcsv($newFile, $newPerson);
    
    }
    fclose($histFile);
    fclose($newFile);
    
    ?>
