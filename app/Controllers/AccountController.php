<?php
namespace App\Controller;

use App\Models\Account;
use Controller;
use Exception;
use Response;

class AccountController extends Controller
{
    protected $table = 'account';
    public $response;
    public $accounts;
    public $data = [];

    public function __construct() {
         $this->accounts = new Account();
         $this->response = new Response();
    }

    public function index() {
        $accounts = $this->db->table($this->table)->select('id')->get();

        return $this->response->json($accounts);
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
        $account = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($account);
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
        