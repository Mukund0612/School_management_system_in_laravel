@extends('layouts.default')

@section('content')

<div class="container" style="margin-top: 100px;">
    <div class="row text-center">
        <img src="{{ asset('/profile_images')}}/{{ $student[0]->profile_image}}" alt="" height="200" width='200' style="border-radius: 50%;" />
        <div class="text-center">
            <h1 style="margin:30px 0px;">{{ $student[0]->stu_name}}'s Profile </h1>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-2 col-md-2 col-1"></div>

            <div class="col-lg-8 col-md-8 col-10 text-center">
                <table class="table table-responsive">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{ $student[0]->stu_name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Father Name</strong></td>
                        <td>{{ $student[0]->fath_name}}</td>
                    </tr>
                    <tr>
                        <td><strong>class</strong></td>
                        <td>{{ $student[0]->class}}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td>{{ $student[0]->phone_no}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $student[0]->email}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-2 col-md-2 col-1"></div>
        </div>
    </div>

@endsection