<?php 

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\View;

class AdminController extends Controller
{
	public string $layout = 'admin';

	public function dashboard()
	{
		return View::make('admin/dashboard', [
			'title' => 'Admin Dashboard'
		]);
	}

	public function login()
	{
		echo 'Admin login';
	}
}
