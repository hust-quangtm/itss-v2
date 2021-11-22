<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query();
        if ($request->name) {
            $users->where('name', 'like', '%' . $request->name . '%');
        }

        $users = $users->orderByDesc('id')->paginate(config('variable.pagination_admin'));
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $request->all();
        $user = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $avatar = uniqid() . "_" . $request->avatar->getClientOriginalName();
            $request->file('avatar')->storeAs('public/users', $avatar);
            $user['avatar'] = $avatar;
        }
        $user['password'] = bcrypt($request->password);
        User::create($user);
        return redirect()->route('admin.users.index')->with('message', __('messages.create_message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = uniqid() . "_" . $request->avatar->getClientOriginalName();
            $request->file('avatar')->storeAs('public/users', $avatar);
            Storage::disk('public')->delete('/users/' . $user->avatar);
            $data['avatar'] = $avatar;
        }
        $user->update($data);
        return redirect()->route('admin.users.index')->with('message', __('messages.update_message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $role = $user->role_id;

        if ($role == User::ROLE['teacher']) {
            $users = Course::where('teacher_id', $id)->first()->get();
            if (count($users) == 0) {
                $user->delete();
                return redirect()->route('admin.users.index')->with('message', __('messages.delete_message'));
            } else {
                return redirect()->route('admin.users.index')
                ->with('message', __('messages.delete_message_error_user'));
            }
        }

        if ($role == User::ROLE['user']) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('message', __('messages.delete_message'));
        }
    }
}
