<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends BaseController
{
	public function login()
	{
		echo 'RETURN SOMETHING BITCH!';
		die();
		// $model = new UserModel();
		// helper('form','url');
		// $user = $this->request->getVar('user');
		// $pass = $this->request->getVar('password');

		// $data['user'] = $model->where('user', $user)->where('password', $pass)->get('Users');
		// $data['token'] = [
        //     'name_csrf' => csrf_token(),
        //     'hash' => csrf_hash()
		// ];
		// echo json_encode($data);
	}
	public function pruebas()
	{
		echo "ALV";
	}


}
