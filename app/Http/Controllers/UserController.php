<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('create','store','search');
        $this->middleware('auth')->only('index','show','update');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate(15);
        return view('user.index',compact('users'))->render();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user)
    {

      return view('user.edit', compact('user'));
    }

    public function edit2( User $user)
    {

      return view('user.edit2', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'password1' => ['required'],
            'password2' => ['same:password1'],
        ]);
        // dd($request);
        User::find($user->id)->update(['password' => Hash::make($request->password1)]);
        // dd($u);

        return redirect()->back()->with('success','เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
    }

    public function update2(Request $request , User $user)
    {
        // dd($request->password1);
        $request->validate([
            'name' => ['required'],
            'password1' => [],
            'password2' => ['same:password1'],
        ]);

        if (!empty($request->password1)) {
            User::find($request->id)->update([
                'name' => $request->name,
                'password' => Hash::make($request->password1),
            ]);
            return redirect()->back()->with('success','แก้ไข้ Password เรียบร้อยแล้ว');
        }else {
            User::find($request->id)->update($request->only(['name']));
            return redirect()->back()->with('success','แก้ไข้ข้อมูลเรียบร้อยแล้ว');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user ,Request $request)
    {
        $check = User::destroy($request->user_id);
        if ($check) {
            return  redirect()->back()->with('success','ลบ User แล้ว '.$request->name );
        }else {
            return  redirect()->back()->with('danger','เกิดข้อผิดพลาด');
        }

    }

    public function search (Request $request)
    {

        $search = $request->get('search');
        $users = User::select()
                    ->where('name','like','%'.$search.'%')
                    ->orWhere('email','like','%'.$search.'%')
                    ->paginate(10);

        return view('user.index',compact('users','search'))->render();
    }
}
