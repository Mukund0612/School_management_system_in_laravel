@extends('layouts.default')

@section('content')

<h1>Students Details</h1>

<input type="text" class="form-control" id="student_search" placeholder="Search for.........." style="margin: 10px 0px" />

    <input type="checkbox" class="paramiter" id="paramiter_1" name="param[]" value=" fath_name">
    Father name
    <input type="checkbox" class="paramiter" id="paramiter_2" name="param[]" value="class">
    Class
    <input type="checkbox" class="paramiter" id="paramiter_3" name="param[]" value="phone_no">
    Phone Number
    <input type="checkbox" class="paramiter" id="paramiter_4" name="param[]" value="email">
    Email
@if(session()->has('update'))
<div class="alert alert-success">
    {{ session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('delete'))
<div class="alert alert-danger">
    {{ session()->get('delete')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="table-responcive">
    <table class="table table-bordered search_content">
        <thead>
            <th>No.</th>
            <th class="column_shorting" data-shorting_type="asc" data-column_name="stu_name" style="cursor:pointer">Student Name</th>
            <th class="column_shorting" data-shorting_type="asc" data-column_name="fath_name" style="cursor:pointer">Student Father Name</th>
            <th>Class</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>View Profile</th>
            <th>Add fees</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @include('student_details_ajax')
        </tbody>
    </table>
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
        <input type="hidden" name="hidden_short_type" id="hidden_short_type" value="asc" />
</div>

@endsection

@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        // for fetch and view all data using ajax
        function fetch_data(page, short_type="", short_by="", search="")
        {
            $.ajax({
                url: "<?php echo URL::to('/'); ?>/student_details_ajax?page="+page+"&short_type="+short_type+"&short_by="+short_by+"&search="+search,
                success: function(data){
                    $('.search_content tbody').html(data);
                }
            })
        }

        // for search
        $(document).on('keyup', '#student_search', function(){
            var search = $('#student_search').val();
            var column_name = $('#hidden_column_name').val();
            var short_type = $('#hidden_short_type').val();
            var page = $('#hidden_page');
            fetch_data(page, short_type, column_name, search);
        });

        // for column shorting
        $(document).on('click', '.column_shorting', function(){
            var column_name = $(this).data('column_name');
            var order_type = $(this).data('shorting_type');
            var reverse_order = '';

            if (shorting_type == 'asc') {
                $(this).data('shorting_type', 'desc');
                reverse_order = 'desc';
            } else {
                $(this).data('shorting_type', 'asc');
                reverse_order = 'asc';
            }

            $('#hidden_column_name').val(column_name);
            $('#hidden_short_type').val(reverse_order);

            var page = $('#hidden_page').val();
            var search = $('#student_search').val();

            fetch_data(page, reverse_order, column_name, search);
        });

        // for pagination
        $(document).on('click', '.pag_link a', function(e){
            e.preventDefault();
            var search = $('#student_search').val();
            var column_name = $('#hidden_column_name').val();
            var short_type = $('#hidden_short_type').val();
            var page = $(this).attr('href').split('page=')[1];

            fetch_data(page, short_type, column_name, search);
        })

        // fetch data on clicking on check box on the fields
        $(document).on('click', '.paramiter', function(){
            var filter = [];
                $('.paramiter:checked').each(function(){
                    filter.push($(this).val());
                })
            
            $.ajax({
                url: "<?php echo URL::to('/'); ?>/student_details?filter="+filter,
                success: function(data){
                    $('.search_content tbody').html(data);
                }
            })
            
        })
    });
</script>
@endpush