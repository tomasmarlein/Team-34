<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VrijwilligerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $name_user = '%' . $request->input('naam') . '%';

        $users = Gebruikers::orderBy('naam')
            ->Where('naam', 'like', $name_user)
            ->orWhere('email', 'like', $name_user)
            ->paginate(12)
            ->appends(['naam'=> $request->input('naam')]);


        $result = compact('users');
        return view('admin.vrijwilligers.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        return redirect('admin/vrijwilligers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $result = compact('user');
        return view('admin.vrijwilligers.edit', $result);
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
        $this->validate($request,[
            'name' => 'required|min:3',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if( $request->has('active') ){
            $user->active = 1;
        }else{
            $user->active = 0;
        }
        if( $request->has('admin') ){
            $user->admin = 1;
        }else{
            $user->admin = 0;
        }

        $user->save();
        session()->flash('success', 'The user <b>' . $user->name . '</b> has been updated');
        return redirect('admin/vrijwilligers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', "The vrijwilliger <b>$user->name</b> has been deleted");
        return redirect('admin/vrijwilligers');
    }


    public function qryVrijwilligers()
    {
        $vrijwilligers = gebruikers::orderBy('naam')
            ->get();
        return $vrijwilligers;
    }
}
