<?php
namespace App\Models;
use Model;
use Request;
use Session;
use Validator;

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
            access,
            staff_id
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
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:account:email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:3|match:password',
                'phone' => 'required|int|callback_check_phone',
                'descentralization' => 'required',
                'staff_id' => 'required'
            ];


            //Set message
            $message = [
                'first_name.required' => 'Họ tên là bắt buộc',
                'last_name.required' => 'Họ tên là bắt buộc',
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email sai định dạng ',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu là bắt buộc',
                'password.min' => 'Mật khẩu tối thiểu là 6 kí tự',
                'confirm_password.required' => 'Nhập lại mật khẩu là bắt buộc',
                'confirm_password.min' => 'Mật khẩu nhập lại là bắt buộc',
                'confirm_password.match' => 'Mật khẩu nhập lại không khớp',
                'phone.required' => 'Số điện thoại là bắt buộc',
                'phone.callback_check_phone' => 'Sai định dạng Số điện thoại',
                'descentralization.required' => 'Bắt buộc chọn quyền đăng nhập',
                'staff_id.required' => 'Bắt buộc chọn ID nhân viên',
            ];

            $validate = $validator->make($rules,$message);

            if (!$validate) {
                Session::flash('errors_signin', $validator->errors());
                Session::flash('msg_signin', 'Đã xảy ra lỗi, vui lòng thử lại');
                Session::flash('old_signin', $request->getFields());
            }  
            return $validate;
        }

        return false;
    }
}
        