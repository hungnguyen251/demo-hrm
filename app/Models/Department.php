<?php
namespace App\Models;
use Model;

class Department extends Model
{
    protected $table = "department_info";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
            id,
            department_code,
            department_name,
            editor_id
        ';
    }

    public function primaryKey() {
        return 'id';
    }
}
        