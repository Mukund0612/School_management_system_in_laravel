    @foreach($students as $student)
    <tr>
        <td>{{$student->id}}</td>
        <td>{{$student->stu_name}}</td>
        <td>{{$student->fath_name}}</td>
        <td>{{$student->class}}</td>
        <td>{{$student->phone_no}}</td>
        <td>{{$student->email}}</td>
        <td class="text-center"><a href="{{route('single-student', ['id' => $student->id])}}"><i class="fa fa-eye" aria-hidden="true" style="font-size:25px"></i></a></td>
        <td><a href="{{route('student-fees', ['id' => $student->id])}}">Fees</a></td>
        <td><a href="{{route('student-edit', ['id' => $student->id])}}">Edit</a></td>
        <td><a href="{{route('student-delete', ['id' => $student->id])}}">Delete</a></td>
    </tr>
    @endforeach
    <tr><td class="pag_link" colspan="10">{{$students->links()}}</td></tr>
