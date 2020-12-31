@extends('layouts.admin')

@section('title', 'Files')

@section('head')
    @include('admin.head.datatable')
@endsection

@section('content')
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Files for {{ $file_section->name }}</h4>
            </div>
            <div class="card-body">
                @include('flash::message')
                <div class="table-responsive">
                    <table id="example5" class="display">
                        <thead>
                            <th>File</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        @if($files)
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <form method="post" action="{{ route('admin.files.destroy', $file->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="button" onclick="return confirm('Are you sure you want to delete this file?')"
                                                        class="btn btn-danger shadow btn-xs sharp">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
