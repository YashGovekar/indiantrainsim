@extends('layouts.admin')
@section('title', 'File Sections')

@section('head')
    @include('admin.head.datatable')
@endsection

@section('content')
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All File Sections</h4>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <a class="btn btn-primary" href="{{ route('admin.file-sections.create') }}">
                        Add New File Section
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example5" class="display">
                        <thead>
                            <th>File Section</th>
                            <th>Files</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        @if($file_sections)
                            @foreach($file_sections as $file_section)
                                <tr>
                                    <td>{{ $file_section->name }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.file-sections.files', $file_section->id) }}">
                                            Manage Files
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.file-sections.edit', $file_section->id) }}"
                                               class="btn btn-primary shadow btn-xs sharp mr-1">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form method="post" action="{{ route('admin.file-sections.destroy', $file_section->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Are you sure?')"
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
