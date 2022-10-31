<?php
namespace App\Models;
use Model;

class Company extends Model
{
    protected $table = "company_info";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '*';
    }

    public function primaryKey() {
        return 'id';
    }
}
        