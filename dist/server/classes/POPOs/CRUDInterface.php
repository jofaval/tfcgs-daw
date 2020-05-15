<?php
interface CRUD
{
    public function create();
    public function update();
    public function delete();
    public function query();
    public function fill();
    public function parse();
}