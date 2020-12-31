@extends('layouts.admin')

@section('title', 'Users')

@section('head')
    @include('admin.head.datatable')
@endsection

@section('content')
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example5" class="display">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Files Contributed</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->files->count() }}</td>
                                    <td class="text-center">
                                        <form method="post" action="{{ route('admin.users.destroy', $user->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-xs sharp" type="submit" onclick="return confirm('Are you sure, you want to delete this user?')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('admin.scripts.datatable')
@endsection
