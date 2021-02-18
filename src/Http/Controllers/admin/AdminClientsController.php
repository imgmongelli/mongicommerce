<?php
namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Mongi\Mongicommerce\Models\User;
use Mongi\Mongicommerce\Http\Controllers\Controller;


class AdminClientsController extends Controller
{
    public function page(){
        $clients = User::where('admin',false)->get();
        return view('mongicommerce::admin.pages.clients',compact('clients'));
    }
}
