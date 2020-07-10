<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Utilities extends BaseController
{
	public function getToken()
	{
        $csrfData[] = [
            'name_csrf' => csrf_token(),
            'hash' => csrf_hash()
        ];

        echo json_encode($csrfData);
	}
    public function alvc(){
        echo "POS ALVC";
    }

}
