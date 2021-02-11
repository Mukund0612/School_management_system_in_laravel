@extends('layouts.default')

@section('content')
<h1>Students Details</h1>
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