<?php
namespace App\Controller;

use App\Models\Salary;
use Controller;
use Exception;
use Response;

class SalaryController extends Controller
{
    protected $table = 'salary_info';
    public $response;
    public $salaries;
    public $data = [];

    public function __construct() {
         $this->salaries = new Salary();
         $this->response = new Response();
    }

    public function index() {
        $salaries = $this->db->table($this->table)->get();

        return $this->response->json($salaries);
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
        $salary = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($salary);
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
        