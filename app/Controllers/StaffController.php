<?php
namespace App\Controller;

use App\Models\Staff;
use Controller;
use Exception;
use Response;

class StaffController extends Controller
{
    protected $table = 'staff_info';
    public $response;
    public $staffs;
    public $data = [];

    public function __construct() {
         $this->staffs = new Staff();
         $this->response = new Response();
    }

    public function index() {
        $staffs = $this->db->table($this->table)->get();

        // return $this->response->json($staffs);
        $this->data['sub_content']['new_title'] = $staffs;
        $this->data['content'] = 'staffs/staff';

        $this->render('layouts\client_layout', $this->data);
    }

    public function store($data) {
        //store
        try {
            $this->db->table($this->table)->insert($data);
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi thêm bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function show($id) {
        //show
        $staff = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($staff);
    }

    public function update($data, $id) {
        //update
        try {
            $this->db->table($this->table)->where('id','=', $id)->update($data);
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi sửa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function destroy($id) {
        //destroy
        try {
            $this->db->table($this->table)->where('id','=', $id)->delete();
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi xóa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function getUserInfo($id) {
        $user = $this->db->table($this->table)
        ->leftJoin('department_info', 'staff_info.department_id = department_info.id')
        ->leftJoin('diploma', 'staff_info.diploma_id = diploma.id')
        ->leftJoin('position', 'staff_info.position_id = position.id')
        ->leftJoin('marriage_status', 'staff_info.marriage_code = marriage_status.id')
        ->leftJoin('staff_type', 'staff_info.staff_type_id = staff_type.id')
        ->leftJoin('reward_discipline', 'staff_info.id = reward_discipline.staff_id')
        ->where('staff_info.id','=', $id)->get();

        $this->data['sub_content']['user_info'] = $user;
        $this->data['content'] = 'profile/show';

        $this->render('layouts\client_layout', $this->data);
    }
}
        