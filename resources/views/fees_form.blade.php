@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                </br>
                    <form action="{{ url('pay_fees')}}" method="post" id="fees_form" class="form-horizontal form-label-left">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Amount
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="amount" class="form-control col-md-7 col-xs-12" id="amount" required="required">
                                <input type="hidden" name="id" value="{{$id}}">
                            </div>
                            <div>
                            <h2 style='margin: 10px'> Fees deposited : 
                            @php
                                $total_fees = 0;
                                if ($fees) {
                                    foreach ($fees as $key => $value) {
                                        $total_fees += $value['amount'];
                                    }
                                    echo $total_fees;
                                }
                            @endphp
                            </h2>
                            </div>
                        </div>
                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="margin-top: 10px;">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection