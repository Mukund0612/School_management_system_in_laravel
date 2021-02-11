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
<div class="pag_link">
    {{$students->links()}}
</div>