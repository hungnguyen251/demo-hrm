<?php
namespace App\Controller;

use App\Models\Reward;
use Controller;
use Exception;
use Response;

class RewardController extends Controller
{
    protected $table = 'reward_discipline';
    public $response;
    public $rewards;
    public $data = [];

    public function __construct() {
         $this->rewards = new Reward();
         $this->response = new Response();
    }

    public function index() {
        $rewards = $this->db->table($this->table)->get();

        return $this->response->json($rewards);
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
        $reward = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($reward);
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
        