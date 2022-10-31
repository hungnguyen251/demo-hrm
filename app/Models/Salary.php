<?php
namespace App\Models;
use Model;

class Salary extends Model
{
    protected $table = "salary_info";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
            id,
            salary_code,
            staff_id,
            salary_per_month,
            work_day,
            allowance,
            payment,
            advance,
            received,
            timekeeper,
            note,
            month_salary,
            editor_id
        ';
    }

    public function primaryKey() {
        return 'id';
    }
}
        