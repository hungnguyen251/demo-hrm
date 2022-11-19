<?php
namespace App\Controller;

use App\Models\Company;
use Controller;
use Exception;
use Response;

class CompanyController extends Controller
{
    protected $table = 'company_info';
    public $response;
    public $company;
    public $data = [];

    public function __construct() {
         $this->company = new Company();
         $this->response = new Response();
    }

    public function index() {
        $company = $this->db->table($this->table)->get();

        $this->data['sub_content']['company'] = $company;
        $this->data['content'] = 'company/show';

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
        $company = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($company);
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
        