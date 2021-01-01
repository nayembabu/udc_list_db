
<div class="container">
<br>
    <h2>Search data </h2>

    <div class="col-md-6 mx-auto">
    
        <div class="form-inline">
            <input type="text" id="search" class="form-control search mr-3 searcing_options" placeholder="type your data">
            <button type="button" class="btn btn-success search_btn">Search</button>
        </div>
    </div>
<br>

<!-- table -->

<table class="table table-hover table-striped searcing_data_assign"></table>



</div>


<script type="text/javascript">

    $(document).on('click', '.search_btn', function () {
        var type_search_data = $('.searcing_options').val();
        if (type_search_data != '') {
            $.ajax({
                url: 'main/get_udc_info_by_json?search_info=' + type_search_data,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (udc_info) {
                    var html_data = '';
                    for (let n = 0; n < udc_info.length; n++) {
                        html_data += '<tr>'+
                                        '<td>'+udc_info[n].udc_person_name+'</td>'+
                                        '<td>'+udc_info[n].udc_mobile_no+'</td>'+
                                        '<td>'+udc_info[n].udc_email+'</td>'+
                                        '<td>'+udc_info[n].union_name+'</td>'+
                                        '<td>'+udc_info[n].upazilla_name+'</td>'+
                                        '<td>'+udc_info[n].dist_name+'</td>'+
                                        '<td>'+udc_info[n].div_name+'</td>'+
                                    '</tr>';
                    }
                    $('.searcing_data_assign').html('<thead>'+
                                    '<tr>'+
                                        '<th> udc name </th>'+
                                        '<th> phone </th>'+
                                        '<th> email </th>'+
                                        '<th> Union </th>'+
                                        '<th> Upzila </th>'+
                                        '<th> Dist name </th>'+
                                        '<th> Div name </th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    html_data+
                                '</tbody>'
                                );
                } 
            })
        }else {
            $('.searcing_data_assign').html('Search box empty...');
        }
    });

</script>


