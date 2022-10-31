<?php
namespace App\Models;
use Model;

class Staff extends Model
{
    protected $table = "staff_info";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
            id,
            staff_code,
            avatar,
            staff_fullname,
            nickname,
            gender,
            date_of_birth,
            place_of_birth,
            marriage_code,
            id_number,
            place_issue_id,
            date_issue_id,
            domicile,
            nationality_id,
            religion_id,
            ethnicity_id,
            permanent_residence,
            temporality_residence,
            staff_type_id,
            level_id,
            speciality_id,
            diploma_id,
            department,
            position_id,
            status,
            editor_id
        ';
    }

    public function primaryKey() {
        return 'id';
    }
}
        