@extends('layouts.default')

@section('content')

<h1>Students Details</h1>

<input type="text" class="form-control" id="student_search" placeholder="Search for.........." style="margin: 10px 0px" />

<div class="table-responcive">
    <table class="table table-bordered search_content">
        <thead>
            <th>No.</th>
            <th class="column_shorting" data-shorting_type="asc" data-column_name="stu_name" style="cursor:pointer">Student Name</th>
            <th class="column_shorting" data-shorting_type="asc" data-column_name="fath_name" style="cursor:pointer">Student Father Name</th>
            <th>Class</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        @include('student_details_ajax')

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="1id" />
        <input type="hidden" name="hidden_short_type" id="hidden_short_type" value="asc" />
</div>

@endsection

@push('footer_scripts')
<script type="text/javascript">
    $(document).ready({
        // for fetch and view all data using ajax
        function fetch_data(page, short_type="", short_by="", search="")
        {
            console.log("<?php// echo URL::to('/'); ?>/student_details_ajax?page="+page+"&short_type="+short_type+"&short_by="+short_by+"&search="+search);
            $.ajax({
                url: "<?php// echo URL::to('/'); ?>/student_details_ajax?page="+page+"&short_type="+short_type+"&short_by="+short_by+"&search="+search,
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
            var page = $(this).attr('href').split('page=')[1];

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
    });
</script>
@endpush