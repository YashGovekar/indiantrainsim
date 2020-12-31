@extends('layouts.admin')
@section('title', 'Dashboard')

@section('head')
    @include('admin.head.datatable')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All File Sections</h4>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <a class="btn btn-primary" href="{{ route('admin.news-feeds.create') }}">
                        Add NewsFeed
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('flash::message')
                <div class="table-responsive">
                    <table class="display">
                        <thead>
                            <th>Subject</th>
                            <th>Body</th>
                            <th>Image</th>
                            <th>Post Date</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        @if($news_feeds)
                            @foreach($news_feeds as $news_feed)
                                <tr>
                                    <td>{{ $news_feed->subject }}</td>
                                    <td>{{ $news_feed->body }}</td>
                                    <td class="text-center">
                                        <img class="w-25" src="{{ $news_feed->image }}" alt="{{ $news_feed->subject }}" />
                                    </td>
                                    <td>{{ $news_feed->created_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.news-feeds.edit', $news_feed->id) }}"
                                               class="btn btn-primary shadow btn-xs sharp mr-1">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form method="post" action="{{ route('admin.news-feeds.destroy', $news_feed->id) }}">
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
