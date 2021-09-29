<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $dataUsers = User::paginate(10); // mengambil data dengan elequen

        // return view('user.list', compact('dataUsers'));

        // $dataUsers = DB::table('users')->select('name', 'email')->get(); // mengambil data sesuai yang select
        // $dataUsers = DB::table('users')->distinct()->get(); // mengambil data yang berbeda
        // $dataUsers = DB::table('users')->select('name AS testing')->get(); // mengambil data di inisialkan
        // $dataUsers = DB::table('users')->select()->where('status', '=', 'INACTIVE')->get(); // mengambil data dengan menggunakan operator 
        // $dataUsers = DB::table('users')->select()->where('status', '=', 'INACTIVE')->orWhere('name', 'fajri')->get(); // mengambil data dengan menggunakan operator dan statement 
        // $dataUsers = DB::table('users')->select()->whereStatusAndName('ACTIVE', 'fajri')->get(); // mengambil data dengan menggunakan dynamic where
        // dd($dataUsers); //debug

        // $dataUsers = DB::table('users')->select('id', 'name', 'username', 'email', 'avatar', 'status')->get(); // mengambil data di inisialkan
        $dataUsers = DB::table('users')->select('id', 'name', 'username', 'email', 'avatar', 'status')->orderBy('id')->paginate(10); // mengambil data di inisialkan

        // filter
        $keyEmail  = $request->get('keywordEmail');
        $keyStatus = $request->get('keyStatus');
        // dd($keyStatus);
        
        if($keyEmail){
            $dataUsers = DB::table('users')->where("email", "like", "%$keyEmail%")->paginate(10);
        }

        if($keyStatus){
            $dataUsers = DB::table('users')->where("status", "like", "%$keyStatus%")->paginate(10);
        }

        return view('user.list', compact('dataUsers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
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
        // query elequent
        // cek matching password
        // $pass = $request->get('password');
        // $repass = $request->get('repassword');
        
        // if($pass == $repass){
        //     $new_user = new User;
        //     $new_user->name     = $request->get('name');
        //     $new_user->username = $request->get('username');
        //     $new_user->roles    = json_encode($request->get('roles'));
        //     $new_user->phone    = $request->get('phone');
        //     $new_user->address  = $request->get('address');
        //     $new_user->email    = $request->get('email');
        //     $new_user->password = \Hash::make($pass);
        //     $new_user->status   = $request->get('status');
            
        //     if($request->file('avatar')){
        //         $file = $request->file('avatar')->store('avatars', 'public');
        //         $new_user->avatar = $file;
        //         $new_user->avatar = $file;
        //         $new_user->save();
        //         return redirect()->route('users.create')->with('status', 'sukses');
        //     }else{
        //         return redirect()->route('users.create')->with('status', 'gambar invalid');
        //     }             
        // }else{
        //     return redirect()->route('users.create')->with('status', 'password no match');
        // }

        // query builder
        /*
        // digunakan untuk mengecek nilai inputan ada
        // if($request->has(['name', 'username'])){

        // }
        */

        $pass = $request->get('password');
        $repass = $request->get('repassword');

        if($pass == $repass){
            if($request->file('avatar')){
                $file = $request->file('avatar')->store('avatars', 'public');
                DB::table('users')->insert([
                    'name'      => $request->get('name'),
                    'username'  => $request->get('username'),
                    'roles'     => json_encode($request->get('roles')),
                    'phone'     => $request->get('phone'),
                    'address'   => $request->get('address'),
                    'email'     => $request->get('email'),
                    'password'  => \Hash::make($pass),
                    'status'    => $request->get('status'),
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s"),
                    'avatar'    => $file
                ]);

                return redirect()->route('users.create')->with('status', 'sukses');
            }else{
                 return redirect()->route('users.create')->with('status', 'gambar invalid');
            }
        }else{
            return redirect()->route('users.create')->with('status', 'password no match');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data_user = DB::table('users')->where('id', $id)->first();

        return view('user.detail', compact('data_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $data_user = User::findOrFail($id);

        // return view("user.edit", ["user" => $data_user]);

        // ->pluck() == digunakan untuk mengambil column sesuai yang di tentukan
        $user = DB::table('users')->where('id', $id)->first();

        return view('user.edit', compact('user'));
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
        $pass = $request->get('password');
        $repass = $request->get('repassword');

        if($pass == $repass){
            if ($request->file('avatar')) {
                $data_user = DB::table('users')->where('id', $id)->first();
                if(file_exists(storage_path('app/public/' . $data_user->avatar))){
                    \Storage::delete('public/'.$data_user->avatar);
                } 
                $file = $request->file('avatar')->store('avatars', 'public');
                DB::table('users')->where('id', $id)->update([
                    'name'      => $request->get('name'),
                    'username'  => $request->get('username'),
                    'roles'     => json_encode($request->get('roles')),
                    'phone'     => $request->get('phone'),
                    'address'   => $request->get('address'),
                    'email'     => $request->get('email'),
                    'password'  => \Hash::make($pass),
                    'status'    => $request->get('status'),
                    'avatar'    => $file
                ]);

                return redirect()->route('users.index')->with('status', 'sukses');       
            }else{
                DB::table('users')->where('id', $id)->update([
                    'name'      => $request->get('name'),
                    'username'  => $request->get('username'),
                    'roles'     => json_encode($request->get('roles')),
                    'phone'     => $request->get('phone'),
                    'address'   => $request->get('address'),
                    'email'     => $request->get('email'),
                    'password'  => \Hash::make($pass),
                    'status'    => $request->get('status')
                ]);
                return redirect()->route('users.index')->with('status', 'gambar invalid');
            }
        }else{
            return redirect()->route('users.edit', $id)->with('status', 'password no match');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data_user = DB::table('users')->where('id', $id)->first();
        
        if(file_exists(storage_path('app/public/' . $data_user->avatar))){
            \Storage::delete('public/'.$data_user->avatar);
        }

        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('users.index')->with('status', 'Berhasil Hapus');
    }
}
