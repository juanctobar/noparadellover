<?php
interface model_mappers_dbInterface
{
	//protected function connectDBMS();
	//protected function selectDB();
	
	public function findFields($tablename, $data);
	public function findPkDesc($tablename, $pkField, $descField);
	public function insert($tablename, $data, $id);
	public function update($tablename, $data, $id);
	public function delete($tablename, $id);
}