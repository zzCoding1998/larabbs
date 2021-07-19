<?php


namespace App\Http\Controllers;


class StaticPagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }

}
