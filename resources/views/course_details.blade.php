@extends('layouts.default')

@section('content')
<h1>Course Details</h1>
<div class="table-responcive">
    <table class="table table-bordered">
        <thead>
            <th>No.</th>
            <th>Branch Short Name</th>
            <th>Course Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->branch_full_name}}</td>
                <td>{{$course->course_name}}</td>
                <td class="text-center"><a href="{{ route('course-edit', ['id' => $course->id ])}}"><i class="fa fa-edit"></i></a></td>
                <td class="text-center"><a href="{{ route('course-delete', ['id' => $course->id])}}"><i class="fa fa-trash"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$courses->links()}}
@endsection