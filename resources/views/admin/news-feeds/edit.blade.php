@extends('layouts.admin')

@section('title', 'Edit NewsFeed : '.$news_feed->name)

@section('content')
    <div class="col-xl-7 col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit a NewsFeed</h4>
                <h4 class="ml-auto">
                    <a class="btn btn-info btn-xs" href="{{ route('admin.news-feeds.index') }}">
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
                    <form method="post" action="{{ route('admin.news-feeds.update', $news_feed->id) }}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="subject">Subject</label>
                            <div class="col-sm-8">
                                <input name="subject" id="subject" class="form-control" value="{{ $news_feed->subject }}" placeholder="Enter Subject" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="body">Body</label>
                            <div class="col-sm-8">
                                <textarea name="body" id="body" class="form-control" placeholder="Enter News Body" required>{{ $news_feed->body }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="image">Image</label>
                            <div class="col-sm-8">
                                <img class="w-25" src="{{ $news_feed->image }}" alt="{{ $news_feed->subject }}" />
                                <input type="file" name="image" id="image" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Edit NewsFeed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
