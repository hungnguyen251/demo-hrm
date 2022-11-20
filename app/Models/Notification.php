<?php
namespace App\Models;
use Model;
use Request;
use Session;
use Validator;

class Notification extends Model 
{
    protected $table = "notification";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
            id,
            title,
            content,
            staff_id,
            author,
            created_at,
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
                'title' => 'required',
                'content' => 'required',
            ];


            //Set message
            $message = [
                'title.required' => 'Tiêu dề là bắt buộc',
                'content.required' => 'Nội dung là bắt buộc',
            ];

            $validate = $validator->make($rules,$message);

            if (!$validate) {
                Session::flash('errors_noti', $validator->errors());
                Session::flash('msg_noti', 'Đã xảy ra lỗi, vui lòng thử lại');
                Session::flash('old_data_noti', $request->getFields());
            }  
            return $validate;
        }

        return false;
    }
}
        