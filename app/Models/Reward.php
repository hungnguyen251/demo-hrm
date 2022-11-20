<?php
namespace App\Models;
use Model;
use Request;
use Session;
use Validator;

class Reward extends Model
{
    protected $table = "reward_type";

    public function tableFill() {
        return $this->table;
    }

    public function fieldFill() {
        return '
        id,
        reward_code,
        reward_name,
        amount,
        note,
        created_at
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
                'reward_name' => 'required',
                'amount' => 'required|int',
                'reward_code'=> 'required',
            ];


            //Set message
            $message = [
                'reward_name.required' => 'Tên giải thưởng là bắt buộc',
                'amount.required' => 'Tiền thưởng là bắt buộc',
                'amount.int' => 'Tiền thưởng phải là số nguyên',
                'reward_code.required' => 'Mã giải thưởng là bắt buộc',
            ];

            $validate = $validator->make($rules,$message);

            if (!$validate) {
                Session::flash('errors_reward', $validator->errors());
                Session::flash('msg_reward', 'Đã xảy ra lỗi, vui lòng thử lại');
                Session::flash('old_data_reward', $request->getFields());
            }  
            return $validate;
        }

        return false;
    }
}
        