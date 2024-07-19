@extends('layout.app')
@section('title','Ideas | Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>COMMENTS</h1>
            @include('shared.success-message')
            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Idea</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($comments as $comment)
                    <tbody>
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>
                                <a href="{{route('users.show', $comment->user)}}">{{$comment->user->name}}</a>
                            </td>
                            <td>
                                <a href="{{route('ideas.show', $comment->idea)}}">{{$comment->idea->id}}</a>
                            </td> 
                            <td>{{$comment->content}}</td>
                            <td>{{$comment->created_at->toDateString()}}</td>
                            <td>
                                <form action="{{route('admin.comments.destroy', $comment)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
