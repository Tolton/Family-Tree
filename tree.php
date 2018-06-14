<?php
    class TreeNode {
        
        public $value;
        public $children = array();
        
        public function __construct($item) {
            $this->value = $item;
        }
        
        protected function addChild($item) {
            array_push($this->children, $item);
        }
        
        public function printThis() {
            echo "<p>";
            echo $this->value->printPerson();
            echo "</p>";
        }
        public function hasChild() {
            return count($this->children);
        }
        public function getID() {
            return $this->value->getID();
        }
        
        
        
    }
    
    class Tree {
        protected $root;
        
        //Constructor for the tree. Create a placeholder for the top level so there can be many children instead of only one top level child/parent.
        public function __construct() {
            $this->root = new TreeNode(new Person(null, Fake, PlaceHolder, Here, "This is a placeholder.", 000, here, noImage));
        }
        public function isEmpty() {
            return $this->root == null;
        }
        //Create the item as a node then call insertNode to insert into the tree
        public function insert($item) {
            $newNode = new TreeNode($item);
            
            if ($this->isEmpty()) {
                
                $this->root = $newNode;
                
            } else {
                //add the node as a certain child
                $this->insertNode($newNode, $this->root);
            }
        }
        
        function getRoot() {
            return $this->root;
        }
        //Getdepth gets the maximum depth of the tree
        function getDepth($child, $depth) {
            if ($child == null) {
                $child = $this->root->children;
            }
            
            foreach($child as $value) {
                //echo "<pre>";print_r($value->getID()); echo "</pre>";
                if ($value->hasChild() > 0) {
                    $depth = $this->getDepth($value->children, $depth);
                } else {
                    if (strlen($value->getID()) > $depth) {
                        $depth = strlen($value->getID());
                    }
                    //return $depth;
                }
            }
            return $depth;
        }
        //genCount gets the count of the specified generation
        function genCount($child, $depth) {
            if ($child == null) {
                $child = $this->root->children;
            }
            if ($depth == 0) {
                return count($this->root->children);
            }
            $count = 0;
            foreach($child as $value) {
                
                //echo "<pre>";print_r($value->getID()." ");print_r($depth);echo "</pre>";
                if (strlen($value->getID()) == $depth) {
                    //echo "<pre>";print_r($value); echo "</pre>";
                    $count += $value->hasChild();
                } else if ($value->hasChild() > 0) {
                    $count += $this->genCount($value->children, $depth);
                }
            }
            return $count;
        }
        //recursively call insertNode to insert the node as a child into the tree
        private function insertNode($newNode, &$subtree) {
            //echo "<pre>";print_r($newNode); echo "</pre>";
            if ($subtree === null) {
                $subtree = $newNode;
            } else {
                /*echo "<pre>";
                print_r($subtree);
                echo "</pre>";
                echo "<pre>";
                print_r($newNode);
                echo "</pre>";*/
                if (strlen($newNode->value->getID()) > strlen($subtree->value->getID())) {
                    $this->insertNode($newNode, $subtree->children[$this->getChildID($newNode, $subtree)]);
                }
            }
        }
        //Get the location in the children array where the new node belongs
        private function getChildID($newNode, $currNode) {
            $length = strlen($currNode->value->getID());
            return $newNode->value->getID()[$length];
        }
        function buildTree() {
            $this->printCurrentChildren($this->root);
        }
        //Using the ID of the person who has been clicked, print them and their children using printCurrentChildren()
        function buildByID($parent, $ID) {
            if ($parent == null) {
                $parent = $this->root->children;
            }
            foreach($parent as $value) {
                if ($value->getID() == $ID) {
                    $this->printCurrentChildren($value);
                    break;
                } else if ($value->hasChild() > 0) {
                    $this->buildByID($value->children, $ID);
                   
                }
            }
            
        }
        //Print the parent as well as the children as divs with images and some info
        function printCurrentChildren($parent) {
            if ($parent->getID() != 0) {
                echo "<div class = 'parent'>";
                $parent->printThis();
                echo "</div>";
            }
            $width = 100;
            if ($parent->hasChild() > 0) {
                $width = 100/$parent->hasChild();
            }
            if ($width < 12.5) {
                $width = 12.5;
            }
            foreach($parent->children as $value) {
                echo "<a href = 'openTree.php?ID=".$value->getID()."'>";
                echo "<div class = 'child' style = 'width: ".floor($width)."%;'>";
                $value->printThis();
                echo "</div></a>";
            }
            
            
            
        }
        /*
        //This function prints the tree
        function printChildren($children, $depth) {
            foreach($children as $value) {
                if ($value->hasChild() > 0) {
                    $value->printThis();
                    $depth++;
                    $this->printChildren($value->children, $depth);
                    $depth--;
                } else {
                    $value->printThis();
                }
            }
        }*/
    }


?>
