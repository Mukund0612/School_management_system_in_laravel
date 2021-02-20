@extends('layouts.default')

@section('content')
<h1>Registration</h1>

@if(session()->has('mailsend'))
<div class="alert alert-success">
    {{ session()->get('mailsend')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Design <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ url('student_insert')}}" method='POST' id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Student Name <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="stu_name" id="first-name" class="form-control col-md-7 col-xs-12" value="{{ old('stu_name')}}">
                            @error('stu_name')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Father Name <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="fath_name" id="last-name" name="last-name" class="form-control col-md-7 col-xs-12" value="{{ old('fath_name')}}">
                            @error('fath_name')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Class
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" name="class" class="form-control col-md-7 col-xs-12" type="text" value="{{ old('class')}}">
                            @error('class')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="birthday" name='phone_no' class="date-picker form-control col-md-7 col-xs-12" type="text" value="{{ old('phone_no')}}">
                            @error('phone_no')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="birthday" name="email" class="date-picker form-control col-md-7 col-xs-12" type="text" value="{{ old('email')}}">
                            @error('email')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Branch: <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="branch_id" id="" class="date-picker form-control col-md-7 col-xs-12 branches">
                                <option value="">-- Select Branch --</option>
                                @foreach($branches as $branch)
                                <option value="{{$branch->id}}" {{ ( old("branch_id") == $branch->id ? "selected":"") }} >{{$branch->branch_full_name}}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Course: <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="course_id" id="" class="date-picker form-control col-md-7 col-xs-12 courses">
                                <option value="">-- Select Course --</option>
                            </select>
                            @error('course_id')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile Image: <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="profile_image" id="image" class="date-picker form-control col-md-7 col-xs-12">
                            @error('profile_image')
                            <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-scripts')
<script text="text/javascript">
    $(document).on('change', '.branches', function(){
        branch_id = $(this).val();
        $.ajax({
            url: 'student/courses',
            dataType: 'json',
            method: 'POST',
            data:{
                'id':branch_id, '_token': "{{ csrf_token() }}"
            },
            success: function(data){
                
                var courses = '<option value="">-- Select Course --</option>';
                var arr = data.courses.length;
                var aa = data.courses;

                for (var i = 0; i < arr; i++) {
                    courses += '<option value="'+aa[i].id+'"> '+aa[i].course_name+' </option>';
                }
                
                // console.log(courses.length);
                if (arr == 0) {
                    courses = '<option value=""> No Coures Available </option>';
                }

                $('.courses').html(courses);
            }
        })
    });
</script>
@endpush