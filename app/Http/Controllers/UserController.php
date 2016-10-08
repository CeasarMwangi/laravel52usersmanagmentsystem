<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use View;
use Illuminate\Support\Facades\Input;
//use Input;
use Illuminate\Support\Facades\Validator;
//use Validator;
//use Illuminate\Support\Facades\Redirect;
//OR set them in config/app.php 'aliases' => [...]

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //GET http://localhost:8000/users
    public function index()
    {
        //$users = User::all();
        //return $users->toarray();

        // the view is /resources/views/users/index.blade.php
        //return View::make('users.index', compact('users'));//We are passing a compact users array to view

        $users = User::paginate(1);
        return View::make('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //POST http://localhost:8000/users/create
    public function create()
    {
        return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* The Input::all () function fetches all the $_GET and $_POST variables and puts it into a single array. */
        $input = \Input::all();
        //$input = Request::all();
        $validation = Validator::make($input, User::$rules);
        //$result = $validation->passes();
        //echo $result; // True or false
        //return;

        if ($validation->passes())
        {
            //call the Create method of the Model class with the $input array
            //rem the model extends eloquent
            User::create($input);

            return \Redirect::route('users.index');
        }

        return \Redirect::route('users.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user))
        {
            return \Redirect::route('users.index');
        }
        return View::make('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (is_null($user))
        {
            return \Redirect::route('users.index');
        }
        return View::make('users.edit', compact('user'));
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
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);
        if ($validation->passes())
        {
            $user = User::find($id);
            $user->update($input);
            return \Redirect::route('users.show', $id);
        }
        return \Redirect::route('users.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return \Redirect::route('users.index');
    }
}