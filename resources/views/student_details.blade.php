@extends('layouts.default')

@section('content')
<h1>Students Details</h1>
<div class="table-responcive">
    <table class="table table-bordered">
        <thead>
            <th>No.</th>
            <th>Student Name</th>
            <th>Student Father Name</th>
            <th>Class</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{$student->id}}</td>
                <td>{{$student->stu_name}}</td>
                <td>{{$student->fath_name}}</td>
                <td>{{$student->class}}</td>
                <td>{{$student->phone_no}}</td>
                <td>{{$student->email}}</td>
                <td><a href="{{route('student-edit', ['id' => $student->id])}}">Edit</a></td>
                <td><a href="{{route('student-delete', ['id' => $student->id])}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$students->links()}}
@endsection