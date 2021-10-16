<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MX_Controller {

   public function __construct()
   {
      parent::__construct();
   }

   public function index()
   {
      echo modules::run("home");
   }

   public function rfp()
   {
      echo modules::run('rfp');
   }
   
}