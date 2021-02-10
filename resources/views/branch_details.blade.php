@extends('layouts.default')

@section('content')
<h1>Students Details</h1>
<div class="table-responcive">
    <table class="table table-bordered">
        <thead>
            <th>No.</th>
            <th>Branch Short Name</th>
            <th>Branch Full Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach($branches as $branch)
            <tr>
                <td>{{$branch->id}}</td>
                <td>{{$branch->branch_short_name}}</td>
                <td>{{$branch->branch_full_name}}</td>
                <td><!--<a href="{{route('branch-edit', ['id' => $branch->id])}}">Edit</a> --></td>
                <td><!--<a href="{{route('branch-delete', ['id' => $branch->id])}}">Delete</a>--></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$branches->links()}}
@endsection