<?php

class Test_Model extends Base_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'test';
        $this->entity_class = 'Test';
        $this->id_name = 'id_test';

        require APPPATH.'entity/Test.php';
    }

    function create_instance(
         $id = null
        ,$hola = null
		,$chau = null
    ){
        $test = new Test();
        $id = $id != null ? $id : $this->generate_uniqid('TST');
        $test->setIdTest($id);
        $test->setHola($hola);
		$test->setChau($chau);
        return $test;
    }

}