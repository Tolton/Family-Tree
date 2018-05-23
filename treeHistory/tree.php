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
        
        public function printThis($depth) {
            echo "<p>";
            for($i = 0; $i <$depth*5; $i++) {
                echo "&nbsp";
            }
            echo $this->value->printPerson();
            echo "</p>";
        }
        public function hasChild() {
            return count($this->children);
        }
        
        
        
    }
    
    class Tree {
        protected $root;
        
        //Constructor for the tree. Create a placeholder for the top level so there can be many children instead of only one top level child/parent.
        public function __construct() {
            $this->root = new TreeNode(new Person(0, Fake, PlaceHolder, Here, "This is a placeholder.", 000, here));
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
        //recursively call insertNode to insert the node as a child into the tree
        private function insertNode($newNode, &$subtree) {
            if ($subtree === null) {
                $subtree = $newNode;
            } else {
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
        //pretty print the whole Tree
        public function printAll() {
            
            $this->printChildren($this->root->children, 0);
            //echo "<\p>";
            echo "printing...";
            //echo "<pre>";
            /*print_r($this->root); */
        }
        //This function prints the tree
        function printChildren($children, $depth) {
            foreach($children as $value) {
                if ($value->hasChild() > 0) {
                    $value->printThis($depth);
                    $depth++;
                    $this->printChildren($value->children, $depth);
                    $depth--;
                } else {
                    $value->printThis($depth);
                }
            }
        }
    }


?>
