<?php
    include("buildTree.php");
    require('includes/fpdf.php');
    
    
    $treeArray = $_SESSION['array'];
    $buildTree = $_SESSION['tree'];
    $gen1Names = $_SESSION['gen1'];
    
    $genArray[0] = "'Arial',''";
    $genArray[1] = "B";
    $genArray[2] = "I";
    $genArray[3] = "U";
    $genArray[4] = "BI";
   // echo "<pre>";
   // print_r($buildTree->getRoot()->children);
   // echo "</pre>";
    //create the new pdf and add a page
    $pdf = new FPDF();
    $pdf->AddPage();
    //$pdf->SetAutoPageBreak(True, 35);
    
    
    
    // Begin with regular font
    $pdf->SetFont('arial','',12);
    
    //Build the First Page
    $depth = $buildTree->getDepth(null, 0);
    for ($x = 1; $x <= $depth; $x++) {
        switch ($x) {
            case 1:
                $num = "st";
                break;
            case 2:
                $num = "nd";
                break;
            case 3:
                $num = "rd";
                break;
            case 4-10:
                $num = "th";
                break;
                
        }
        $pdf->Write(20, "There are ".$buildTree->genCount(null, $x-1)." people in the ".$x.$num." generation.");
        $pdf->Ln(10);
    }
    $pdf->Ln(20);
    //$pdf->Write(5,'Visit ');
    $i = 0;
    //go through the people in the tree and print them out
    while ($i < count($treeArray[0])) {
        if ($pdf->getY() >= 250) {
            $pdf->addPage();
        }
        if (getGen($treeArray[1][$i]) == 1) {
            $pdf->SetFont("times", "BU", 18);
            $pdf->MultiCell(0, 5, $gen1Names[$i]);
            $pdf->Ln(20);
        }
        $pdf->SetFont("times",$genArray[getGen($treeArray[1][$i])],12);
        $pdf->Image($treeArray[0][$i], null, $pdf->getY(), 30);
        $pdf->Cell(30);
        $pdf->MultiCell(0, 5, "#".$treeArray[1][$i]);
        
        $pdf->Ln(20);
        $i++;
    }
        $pdf->Output();
    
    
    
    //Get the depth of the generation. This is for having various fonts for different generations.
    function getGen($currPerson) {
        $newStr = "";
        $string = str_split($currPerson);
        foreach ($string as $char) {
            if ($char == " ") {
                break;
            } else {
                $newStr = $newStr.$char;
            }
        }
        // Will need to remove the -1 when I change the H for Hazelwood and S for spouse values from the person printing function.
        return count(str_split($newStr)) -1;
    }
    
    
    
    ?>
