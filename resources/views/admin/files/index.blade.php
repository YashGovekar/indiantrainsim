@extends('layouts.admin')

@section('title', 'Files')

@section('head')
    @include('admin.head.datatable')
@endsection

@section('content')
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Files</h4>
            </div>
            <div class="card-body">
                @include('flash::message')
                <ul class="nav nav-tabs card-body-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#pending">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#approved">Approved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#all">All</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                        <div class="table-responsive">
                            <table class="display">
                                <thead>
                                    <th>File</th>
                                    <th>Section</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                @if($files)
                                    @foreach($files->where('approved', 0) as $file)
                                        <tr>
                                            <td>
                                                {{ $file->name }}

                                                <a class="ml-2 text-primary" href="{{ route('admin.files.download', $file->id) }}">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                            <td>{{ $file->section->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="post" action="{{ route('admin.files.update', $file->id) }}">
                                                        @method('patch')
                                                        @csrf
                                                        <input type="hidden" value="1" name="approved" />
                                                        <button type="submit" onclick="return confirm('Are you sure you want to approve this file?')"
                                                                class="btn btn-success shadow btn-xs">
                                                            APPROVE
                                                        </button>
                                                    </form>
                                                    <form method="post" action="{{ route('admin.files.destroy', $file->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')"
                                                                class="ml-2 btn btn-danger shadow btn-xs">
                                                            REJECT
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
                    <div class="tab-pane fade" id="approved" role="tabpanel">
                        <div class="table-responsive">
                            <table class="display">
                                <thead>
                                <th>File</th>
                                <th>Section</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>
                                @if($files)
                                    @foreach($files->where('approved', 1) as $file)
                                        <tr>
                                            <td>
                                                {{ $file->name }}

                                                <a class="ml-2 text-primary" href="{{ route('admin.files.download', $file->id) }}">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                            <td>{{ $file->section->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.files.edit', $file->id) }}" class="btn btn-info shadow btn-xs sharp mr-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form method="post" action="{{ route('admin.files.destroy', $file->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')"
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
                    <div class="tab-pane fade" id="all" role="tabpanel">
                        <div class="table-responsive">
                            <table class="display">
                                <thead>
                                <th>File</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>
                                @if($files)
                                    @foreach($files as $file)
                                        <tr>
                                            <td>
                                                {{ $file->name }}

                                                <a class="ml-2 text-primary" href="{{ route('admin.files.download', $file->id) }}">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                            <td>{{ $file->section->name }}</td>
                                            <td>
                                        <span class="badge badge-{{ $file->approved ? 'success' : 'warning' }}">
                                            {{ $file->approved ? 'APPROVED' : 'PENDING' }}
                                        </span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.files.edit', $file->id) }}" class="btn btn-info shadow btn-xs sharp mr-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form method="post" action="{{ route('admin.files.destroy', $file->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')"
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
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.scripts.datatable')
@endsection
