<?php
namespace App\Models;
use Model;

class Reward extends Model
{
    protected $table = "reward_discipline";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
        id,
        reward_code,
        decision_number,
        decision_date,
        staff_id,
        reward_name,
        rewardType_id,
        reward_form,
        amount,
        flag,
        note,
        editor_id
    ';
    }

    public function primaryKey() {
        return 'id';
    }
}
        