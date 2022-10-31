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

        return $this->response->json($staffs);
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
}
        