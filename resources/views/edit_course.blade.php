@extends('layouts.default')

@section('content')
<h1>Update Course</h1>
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
                <form action="{{ route('course-update', $courses['courses']->id)}}" method='POST' id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Branch <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="branch_id" id="" class="form-control col-md-7 col-xs-12">
                                @foreach($courses['branches'] as $branch)
                                    @php
                                        $select = '';
                                        if ($branch->branch_id == $courses['courses']->branch_id) {
                                            $select = 'selected';
                                        }
                                    @endphp
                                    <option value="{{$branch->id}}" {{$select}}>{{$branch->branch_full_name}}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <p class="validetion_error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Course Name <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="course_name" class="form-control col-md-7 col-xs-12" value="{{$courses['courses']->course_name}}">
                            @error('course_name')
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
