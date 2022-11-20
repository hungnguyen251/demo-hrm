<?php
namespace App\Controller;

use App\Models\Reward;
use Controller;
use Exception;
use Response;
use Session;

class RewardController extends Controller
{
    protected $table = 'reward_type';
    public $response;
    public $rewards;
    public $data = [];

    public function __construct() {
         $this->rewards = new Reward();
         $this->response = new Response();
    }

    public function index() {
        $rewards = $this->db->table($this->table)->orderBy('created_at', 'DESC')->get();

        $this->data['sub_content']['rewards'] = $rewards;
        $this->data['content'] = 'rewards/show';

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
            $this->response->redirect('reward/index');

        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi xóa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function check($id='') {
        $this->rewards->validateData();

        $check = getUrlAction();
        if (!empty($check) ) {
            switch ($check) {
                case 'edit':
                    $this->response->redirect('reward/edit/' . $id);
                    break;

                case 'create':
                    $this->response->redirect('reward/create');
                    break;

                default:
                    $this->response->redirect('reward/index');
                    break;
            }
        }
    }

    public function edit($id) {
        global $config;
        $reward = $this->db->table($this->table)->where('id','=', $id)->get();
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];

        if (isset($sessionData['errors_reward']) && isset($sessionData['old_data_reward']['submit'])) {
            if (!isset($sessionData['errors_reward']['reward_name']) && !isset($sessionData['errors_reward']['amount'])) {
                unset($sessionData['old_data_reward']['submit']);

                if (!isset($sessionData['old_data_reward']['submit'])) {
                    Session::flash('status', 'edit');
                    $this->update($sessionData['old_data_reward'], $id);
                    $this->response->redirect('giai-thuong');
                    exit;
                }
            }
        }

        $this->data['sub_content']['reward'] = $reward;
        $this->data['content'] = 'rewards/edit';

        $this->render('layouts\client_layout', $this->data);
    }

    public function create() {
        global $config;
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];

        if (isset($sessionData['errors_reward']) && isset($sessionData['old_data_reward']['submit'])) {
            if (!isset($sessionData['errors_reward']['reward_name']) && !isset($sessionData['errors_reward']['amount'])) {
                unset($sessionData['old_data_reward']['submit']);
                mt_srand(10);
                $rewardCode = 'LKL' . mt_rand();
                $sessionData['old_data_reward']['reward_code'] = $rewardCode;

                if (!isset($sessionData['old_data_reward']['submit'])) {
                    Session::flash('status', 'add');
                    $this->store($sessionData['old_data_reward']);
                    $this->response->redirect('giai-thuong');
                    exit;
                }
            }
        }

        $this->data['sub_content']['reward'] = '';
        $this->data['content'] = 'rewards/add';

        $this->render('layouts\client_layout', $this->data);
    }
}
        