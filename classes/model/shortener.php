<?php defined('SYSPATH') or die('No direct script access.');

class Model_Shortener extends ORM {
   
   protected $_table_name = 'shortener';
   protected $_primary_key = 'code';
   
   public function __get(string $name)
   {
      if ($name === 'id')
      {
         return $this->code;
      }
      
      if ($name === 'short_url')
      {
         $config_file = Kohana::$config->load('shortener');
         $base_url = $config_file['base_url'];
         return $base_url . $this->code;
      }
      
      return parent::__get($name);
   }
   
   public function save(Validation $validation = NULL)
   {
      if (!$this->loaded())
      {
         // prevent the model being used to create 
         // * Shortener::factory()->shorten($url)
         throw new Exception('Do not use Model_Shortener to shorten. 
            Use the Shortener->shorten() method instead.');
      }
      
      parent::save($validation);
   }
   
}

?>