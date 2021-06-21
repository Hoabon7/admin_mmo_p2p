/* ------------------------------------------------------------------------------
 *
 *  # Login pages
 *
 *  Demo JS code for a set of login and registration pages
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DataTableInit = function() {

    //
    // Setup module components
    //
    // DataTable
    var _componentDatatable = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.')
            return
        }

        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            stateSave: true,
            dom: '<"datatable-header"flB><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Tìm kiếm:</span> _INPUT_',
                searchPlaceholder: 'Nhập từ khóa ...',
                lengthMenu: '<span>Hiển thị:</span> _MENU_',
                info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả',
                infoEmpty: 'Không có dữ liệu',
                infoFiltered: '(Lọc từ _MAX_ bản ghi)',
                emptyTable: 'Không có dữ liệu',
                zeroRecords: 'Không tìm thấy bản ghi thỏa mãn yêu cầu',
                processing: 'Đang xử lý',
                paginate: {
                    'first': 'Trang đầu',
                    'last': 'Trang cuối',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                }
            }
        })
    }


    //
    // Return objects assigned to module
    //

    return {
        initComponents: function() {
            _componentDatatable()
        }
    }
}()


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DataTableInit.initComponents()
})

function flexTable() {
    if ($(window).width() < 768) {
        // $("#DataTables_Table_0 tbody").append($(".table-mobile"))


        // window is less than 768px   
    } else {


        $(".table-responsive-stack").each(function(i) {
            $(this).find(".table-responsive-stack-thead").hide();
            $(this).find('thead').show();
        });



    }
    // flextable   
}

function disableSidebarOnClickContent() {
    $('.content-wrapper').on('click', function(e) {
        $('body').removeClass('sidebar-mobile-main');
    })
}

function mobileViewOrderDatatable() {
    // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
    $('.table-responsive-stack').each(function(i) {
        var id = $(this).attr('id');
        //alert(id);
        $(this).find("th").each(function(i) {
            $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">' + $(this).text() + ':</span> ');
            $('.table-responsive-stack-thead').hide();

        });

    });

    $('.table-responsive-stack').each(function() {
        var thCount = $(this).find("th").length;
        var rowGrow = 100 / thCount + '%';
        //console.log(rowGrow);
        $(this).find("th, td").css('flex-basis', rowGrow);
    });
}


$(document).ready(function() {



    mobileViewOrderDatatable();
    disableSidebarOnClickContent();

    // function flexTable() {
    //     if ($(window).width() < 768) {
    //         // $("#DataTables_Table_0 tbody").append($(".table-mobile"))


    //         // window is less than 768px   
    //     } else {


    //         $(".table-responsive-stack").each(function(i) {
    //             $(this).find(".table-responsive-stack-thead").hide();
    //             $(this).find('thead').show();
    //         });



    //     }
    //     // flextable   
    // }

    flexTable();

    window.onresize = function(event) {
        flexTable();
        mobileViewOrderDatatable();

    };



    //     // document ready
});