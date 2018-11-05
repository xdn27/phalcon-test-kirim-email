<?php  

namespace Application\Models;

class Notes extends \Phalcon\Mvc\Model {

   public $id; 
   public $timestamp; 
   public $message; 

   public function getSource() {
      return 'notes';
   }  
   
   public static function find($parameters = null) { 
      return parent::find($parameters);
   }
   
   public static function findFirst($parameters = null) {
      return parent::findFirst($parameters);
   } 
}