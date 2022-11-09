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
        $accounts = $this->db->table($this->table)->get();

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

    public function login() {
        $this->data['errors_signin'] = Session::flash('errors_signin');
        $this->data['msg_signin'] = Session::flash('msg_signin');
        $this->data['old_signin'] = Session::data('old_signin');

        if (!empty($this->data['old_signin'])) {
            if (!empty($this->data['old_signin']['email']) && !empty($this->data['old_signin']['password'])) {
                $email = $this->data['old_signin']['email'];
                $password = $this->data['old_signin']['password'];

                $userCheck = $this->db->table($this->table)->where('email','=', $email)->where('password','=', $password)->first();

                if ($userCheck) {
                    Session::flash('login_user', $userCheck);

                    $this->response->redirect('staff/getUserInfo/' . $userCheck['staff_id']);
                }
            }
        }

        $this->render('accounts/signin', $this->data);
    }

    public function checkLogin() {
        $this->accounts->validateData();

        $this->response->redirect('account/login');
    }

    public function logout() {
        Session::delete();

        $this->response->redirect('account/login');
    }
}
        