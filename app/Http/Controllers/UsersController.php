<?php


namespace App\Http\Controllers;


use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user,UpdateUserRequest $request)
    {
        $this->authorize('update',$user);

        $data = $request->all();

        if($request->avatar){
            $result = (new ImageUploadHandler())->save($request->avatar,'avatar',$user->id,380);
            if($result){
                $data['avatar'] = $result['path'];
            }else{
                unset($data['avatar']);
            }
        }

        $user->update($data);

        return redirect()->route('users.show', compact('user'))->with('success','更新成功！');
    }
}
