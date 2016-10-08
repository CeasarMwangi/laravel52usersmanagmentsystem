@extends('layouts.users')
@section('main')

    <h1>One User</h1>

    <p>{{ link_to_route('users.create', 'Add new user') }}</p>

    @if ($user->count())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Name</th>
            </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method'
              => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>

            </tbody>

        </table>
    @else
        There is no user
    @endif

@stop