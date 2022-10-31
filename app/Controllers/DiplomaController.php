<?php
namespace App\Controller;

use App\Models\Diploma;
use Controller;
use Exception;
use Response;

class DiplomaController extends Controller
{
    protected $table = 'diploma';
    public $response;
    public $diplomas;
    public $data = [];

    public function __construct() {
         $this->diplomas = new Diploma();
         $this->response = new Response();
    }

    public function index() {
        $diplomas = $this->db->table($this->table)->get();

        return $this->response->json($diplomas);
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
        $diploma = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($diploma);
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
        