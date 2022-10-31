<?php
namespace App\Controller;

use App\Models\Department;
use Controller;
use Exception;
use Response;

class DepartmentController extends Controller
{
    protected $table = 'department_info';
    public $response;
    public $departments;
    public $data = [];

    public function __construct() {
         $this->departments = new Department();
         $this->response = new Response();
    }

    public function index() {
        $departments = $this->db->table($this->table)->get();

        return $this->response->json($departments);
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
        $department = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($department);
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
        