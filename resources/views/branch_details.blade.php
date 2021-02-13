@extends('layouts.default')

@section('content')
<h1>Students Details</h1>

<!-- Flash message after update branch -->
@if(session()->has('update'))
    <div class="alert alert-success">
        {{session()->get('update')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Flash message after Delete branch -->
@if(session()->has('delete'))
    <div class="alert alert-danger">
        {{session()->get('delete')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="table-responcive">
    <table class="table table-bordered">
        <thead>
            <th>No.</th>
            <th>Branch Full Name</th>
            <th>Course Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach($branches as $branch)
            <tr>
                <td>{{$branch->id}}</td>
                <td>{{$branch->branch_short_name}}</td>
                <td>{{$branch->branch_full_name}}</td>
                <td class="text-center"><a href="{{ route('branch-edit', ['id' => $branch->id])}}"><i class="fa fa-edit"></i></a></td>
                <td class="text-center"><a href="{{ route('branch-delete', ['id' => $branch->id])}}"><i class="fa fa-trash"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$branches->links()}}
@endsection