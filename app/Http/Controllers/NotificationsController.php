<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class NotificationsController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);

        Auth::user()->markAsRead();

        return view('notifications.index',compact('notifications'));
    }
}
