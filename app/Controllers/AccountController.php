<?php
namespace App\Controller;

use App\Models\Account;
use Controller;
use Exception;
use Request;
use Response;
use Session;

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
        $accounts = $this->db->table($this->table)->orderBy('created_at','DESC')->get();

        // return $this->response->json($accounts);
        $this->data['sub_content']['accounts'] = $accounts;
        $this->data['content'] = 'accounts/show';

        $this->render('layouts\client_layout', $this->data);
    }

    public function store($data) {
        //store
        try {
            $this->db->table($this->table)->insert($data);
        } catch (Exception $exception) {
            $mess = $exception->getMessage();

            // die($mess);
            $this->data['sub_content']['exception'] = $mess;
            $this->data['content'] = 'accounts/add';
    
            $this->render('layouts\client_layout', $this->data);
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
            $this->response->redirect('account/index');
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi xóa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function login() {
        $this->data['errors'] = Session::flash('errors');
        $this->data['msg'] = Session::flash('msg');
        $this->data['old_data'] = Session::data('old_data');

        if (!empty($this->data['old_data'])) {
            if (!empty($this->data['old_data']['email']) && !empty($this->data['old_data']['password'])) {
                $email = $this->data['old_data']['email'];
                $password = $this->data['old_data']['password'];

                $userCheck = $this->db->table($this->table)->where('email','=', $email)->where('password','=', $password)->first();

                if ($userCheck) {
                    Session::flash('login_user', $userCheck);

                    $this->response->redirect('staff/getUserInfo/' . $userCheck['staff_id']);
                }
            }
        }

        $this->render('accounts/signin', $this->data);
    }

    public function logout() {
        Session::delete();

        $this->response->redirect('account/login');
    }

    public function create() {
        global $config;
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];

        if (isset($sessionData['errors']) && isset($sessionData['old_data']['submit'])) {
            if (!isset($sessionData['errors']['first_name']) && !isset($sessionData['errors']['last_name']) && !isset($sessionData['errors']['email']) && !isset($sessionData['errors']['password']) && !isset($sessionData['errors']['confirm_password']) && !isset($sessionData['errors']['phone']) && !isset($sessionData['errors']['staff_id'])) {
                $status = isset($sessionData['old_data']['status']) && $sessionData['old_data']['status'] == 'on' ? 1 : 0;
                switch ($sessionData['old_data']['decentralization']) {
                    case 'Quản trị viên':
                        $decentralization = 1;
                        break;

                    case 'Nhân viên':
                        $decentralization = 2;
                        break;

                    case 'Kế toán':
                        $decentralization = 3;
                        break;

                    default:
                        $decentralization = 2;
                        break;
                }
                $sessionData['old_data']['decentralization'] = $decentralization;
                $sessionData['old_data']['status'] = $status;
                $sessionData['old_data']['password'] = md5($sessionData['old_data']['password']);

                unset($sessionData['old_data']['submit']);
                unset($sessionData['old_data']['confirm_password']);

                if (!isset($sessionData['old_data']['submit'])) {
                    $this->store($sessionData['old_data']);
                    $this->response->redirect('tai-khoan');
                    exit;
                }
            }
        }

        $this->data['sub_content']['account'] = '';
        $this->data['content'] = 'accounts/add';

        $this->render('layouts\client_layout', $this->data);
    }

    public function check($id='') {
        $this->accounts->validateData();

        $check = getUrlAction();
        if (!empty($check) ) {
            switch ($check) {
                case 'edit':
                    $this->response->redirect('account/edit/' . $id);
                    break;

                case 'create':
                    $this->response->redirect('account/create');
                    break;

                case 'login':
                    $this->response->redirect('account/login');
                    break;

                default:
                    $this->response->redirect('home/index');
                    break;
            }
        }
    }

    public function edit($id) {
        global $config;
        $account = $this->db->table($this->table)->where('id','=', $id)->get();
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];

        if (isset($sessionData['errors']) && isset($sessionData['old_data']['submit'])) {
            if (!isset($sessionData['errors']['first_name']) && !isset($sessionData['errors']['last_name']) && !isset($sessionData['errors']['email']) && !isset($sessionData['errors']['password']) && !isset($sessionData['errors']['phone'])) {
                $status = isset($sessionData['old_data']['status']) && $sessionData['old_data']['status'] == 'on' ? 1 : 0;
                switch ($sessionData['old_data']['decentralization']) {
                    case 'Quản trị viên':
                        $decentralization = 1;
                        break;

                    case 'Nhân viên':
                        $decentralization = 2;
                        break;

                    case 'Kế toán':
                        $decentralization = 3;
                        break;

                    default:
                        $decentralization = 2;
                        break;
                }
                $sessionData['old_data']['decentralization'] = $decentralization;
                $sessionData['old_data']['status'] = $status;
                unset($sessionData['old_data']['submit']);

                if (!isset($sessionData['old_data']['submit'])) {

                    $this->update($sessionData['old_data'], $id);
                    $this->response->redirect('tai-khoan');
                    exit;
                }
            }
        }

        $this->data['sub_content']['accounts'] = $account;
        $this->data['content'] = 'accounts/action';

        $this->render('layouts\client_layout', $this->data);
    }
}