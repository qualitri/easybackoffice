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
        ,$name = null
		,$last = null
    ){
        $test = new Test();
        $id = $id != null ? $id : $this->generate_uniqid('tst');
        $test->setIdTest($id);
        $test->setName($name);
		$test->setLast($last);
        return $test;
    }

}