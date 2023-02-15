// var customurl = SITE_URL;
$(document).ready(function(){
    
    setTimeout(function(){ $('.alert').fadeOut(3000); }, 3000);
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.btn_loader',function(){
        var $this = $(this);
        var html = $this.html();

        var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
        $(this).html(loadingText);
        $(this).prop("disabled", true);

        setTimeout(function(){ 
            $('.btn_loader').html(html);
            $('.btn_loader').prop("disabled", false);
        }, 5000);
    });

    $(document).on('click','.icon_loader',function(){
        var $this = $(this);
        var html = $this.html();

        var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i>';
        $(this).html(loadingText);
        $(this).prop("disabled", true);

        setTimeout(function(){ 
            $('.icon_loader').html(html);
            $('.icon_loader').prop("disabled", false);
        }, 5000);
    });


    $('#site_link_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 3] },
            { "orderable": true, "targets": [1, 2] } ]
    });
    $('#site_link_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 3] },
            { "orderable": true, "targets": [1, 2] } ]
    }); 

    $('#popular_city_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 3] },
            { "orderable": true, "targets": [1, 2] } ]
    });
    $('#popular_city_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 3] },
            { "orderable": true, "targets": [1, 2] } ]
    });

    $('#useful_link_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 3] },
            { "orderable": true, "targets": [1, 2] } ]
    });
    $('#useful_link_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 3] },
            { "orderable": true, "targets": [1, 2] } ]
    });

    $('#user_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 5, 6] },
            { "orderable": true, "targets": [2, 3, 4] } ]
    });

    $('#user_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 6, 7] },
            { "orderable": true, "targets": [1, 2, 3, 4, 5] } ]
    });

    $('#category_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 4, 3] },
            { "orderable": true, "targets": [2] } ]
    });
    $('#category_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 4, 3] },
            { "orderable": true, "targets": [2] } ]
    });

    $('#sub_category_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 4, 5] },
            { "orderable": true, "targets": [2, 3] } ]
    });
    $('#sub_category_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 4, 5] },
            { "orderable": true, "targets": [2, 3] } ]
    }); 
 
    $('#brand_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });
    $('#brand_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#condition_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });
    $('#condition_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });
    
    $('#branch_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#branch_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#role_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });
    $('#role_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });


    $('#faq_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 5] },
            { "orderable": true, "targets": [1, 2, 3] } ]
    });
    $('#faq_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 5] },
            { "orderable": true, "targets": [1, 2, 3] } ]
    });

    $('#faq_category_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });
    $('#faq_category_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#report_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#report_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#commission_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#commission_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });


     $('#country_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 5] },
            { "orderable": true, "targets": [1, 2, 3] } ]
    });

    $('#country_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 5] },
            { "orderable": true, "targets": [1, 2, 3] } ]
    });

    $('#state_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#state_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });


    $('#city_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#city_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#product_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 5, 6] },
            { "orderable": true, "targets": [2, 3, 4] } ]
    });

    $('#product_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 5, 6] },
            { "orderable": true, "targets": [2, 3, 4] } ]
    });


    $('#store_type_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#store_type_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#ship_mode_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#ship_mode_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 2, 3] },
            { "orderable": true, "targets": [1] } ]
    });

    $('#cms_page_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 5] },
            { "orderable": true, "targets": [1, 2, 3,] } ]
    });

    $('#cms_page_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 4, 5] },
            { "orderable": true, "targets": [1, 2, 3] } ]
    });

    $('#general_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 6, 7] },
            { "orderable": true, "targets": [2, 3, 4, 5] } ]
    });

    $('#general_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 6, 7] },
            { "orderable": true, "targets": [2, 3, 4, 5] } ]
    });

    $('#short_banners_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 3, 4] },
            { "orderable": true, "targets": [2] } ]
    });

    $('#short_banners_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 1, 3, 4] },
        { "orderable": true, "targets": [2] } ]
    });

    $('#support_category_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
       "columnDefs": [ { "orderable": false, "targets": [0, 1, 3, 4] },
            { "orderable": true, "targets": [2] } ]
    });

    $('#support_category_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 1, 3, 4] },
        { "orderable": true, "targets": [2] } ]
    });

    $('#subscription_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 2] },
        { "orderable": true, "targets": [1] } ]
    });
    
    $('#subscription_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 2] },
        { "orderable": true, "targets": [1] } ]
    });

    $('#email_log_english_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 5] },
        { "orderable": true, "targets": [1, 2, 3, 4] } ]
    });
    
    $('#email_log_arabic_table').dataTable({
        "bDestroy": true, "lengthChange": true, "bFilter": true, "pageLength": 10,
        "bPaginate": true, "paging": true, "bInfo": true, "stateSave": false,
        "language": { searchPlaceholder: 'Search'},
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
        },
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0, 5] },
        { "orderable": true, "targets": [1, 2, 3, 4] } ]
    });
    
});

