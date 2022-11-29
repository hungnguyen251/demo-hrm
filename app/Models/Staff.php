<?php
namespace App\Models;
use Model;
use Request;
use Session;
use Validator;

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
            date_start_work,
            status,
            editor_id
        ';
    }

    public function primaryKey() {
        return 'id';
    }

    public function validateData() {
        $request = new Request();
        $validator = new Validator();

        //Set rulese
        if ($request->isPost()) {
            $rules = [
                'staff_code' => 'required',
                'avatar' => 'required',
                'staff_fullname' => 'required',
                'gender' => 'required|same:--Chọn--',
                'date_of_birth' => 'required',
                'date_start_work' => 'required',
                'marriage_code' => 'required|same:--Chọn--',
                'id_number' => 'required|min:9',
                'domicile' => 'required',
                'staff_type_id' => 'required|same:--Chọn--',
                'diploma_id' => 'required|same:--Chọn--',
                'department_id' => 'required|same:--Chọn--',
                'position_id' => 'required|same:--Chọn--',
            ];


            //Set message
            $message = [
                'staff_code.required' => 'Mã nhân viên là bắt buộc',
                'avatar.required' => 'Ảnh đại diện là bắt buộc',
                'staff_fullname.required' => 'Họ và tên là bắt buộc',
                'date_start_work.required' => 'Ngày bắt đầu là bắt buộc',
                'gender.same' => 'Lựa chọn bắt buộc',
                'gender.required' => 'Giới tính là bắt buộc',
                'date_of_birth.required' => 'Ngày sinh là bắt buộc',
                'marriage_code.required' => 'Tình trạng hôn nhân là bắt buộc',
                'id_number.required' => 'Số CMND là bắt buộc',
                'id_number.min' => 'Số CMND tối thiểu 9 số',
                'domicile.required' => 'Địa chỉ là bắt buộc',
                'staff_type_id.required' => 'Loại nhân viên là bắt buộc',
                'diploma_id.required' => 'Bằng cấp là bắt buộc',
                'position_id.required' => 'Vị trí là bắt buộc',
                'department_id.required' => 'Phòng ban là bắt buộc',
                'position_id.same' => 'Lựa chọn bắt buộc',
                'staff_type_id.same' => 'Lựa chọn bắt buộc',
                'diploma_id.same' => 'Lựa chọn bắt buộc',
                'department_id.same' => 'Lựa chọn bắt buộc',
                'marriage_code.same' => 'Lựa chọn bắt buộc'
            ];

            $validate = $validator->make($rules,$message);

            if (!$validate) {
                Session::flash('errors_staff', $validator->errors());
                Session::flash('msg_staff', 'Đã xảy ra lỗi, vui lòng thử lại');
                Session::flash('old_data_staff', $request->getFields());
            }  
            return $validate;
        }

        return false;
    }
}
        