<?php
namespace App\Models;
use Model;

class Account extends Model
{
    protected $table = "account";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
            id,
            first_name,
            last_name,
            avatar,
            email,
            password,
            phone,
            descentralization,
            status,
            access
        ';
    }

    public function primaryKey() {
        return 'id';
    }
}
        