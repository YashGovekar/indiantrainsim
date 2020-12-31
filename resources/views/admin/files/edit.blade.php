@extends('layouts.admin')

@section('title', 'Edit File : '.$file->name)

@section('content')
    <div class="col-xl-7 col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit a File</h4>
                <h4 class="ml-auto">
                    <a class="btn btn-info btn-xs" href="{{ route('admin.files.index') }}">
                        Back
                    </a>
                </h4>
            </div>
            <div class="card-body">
                @include('flash::message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="basic-form">
                    <form method="post" action="{{ route('admin.files.update', $file->id) }}">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="name">Name : </label>
                            <div class="col-sm-8">
                                <input name="name" id="name" value="{{ $file->name }}" class="form-control" placeholder="Enter File Details" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="file_section_id">Section : </label>
                            <div class="col-sm-8">
                                <select name="file_section_id" class="form-control" id="file_section_id">
                                    @foreach ($file_sections as $section)
                                        <option value="{{ $section->id }}" @if($section->id == $file->file_section_id) selected @endif>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="description">Description : </label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" id="description">{{ $file->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label checkbox-danger" for="approved">Is Approved : </label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="approved" id="approved" value="1" {{ $file->approved ? 'checked="checked"' : '' }} />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success btn-xs">Edit File</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
