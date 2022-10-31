<?php
namespace App\Models;
use Model;

class Diploma extends Model
{
    protected $table = "diploma";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
            id,
            diploma_code,
            diploma_name,
            editor_id
        ';
    }

    public function primaryKey() {
        return 'id';
    }
}
        