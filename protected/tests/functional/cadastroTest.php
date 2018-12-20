<?php

class cadastroTest extends WebTestCase
{
	public $fixtures=array(
		'cadastros'=>'cadastro',
	);

	public function testShow()
	{
		$this->open('?r=cadastro/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cadastro/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cadastro/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cadastro/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cadastro/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cadastro/admin');
	}
}
