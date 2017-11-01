function myDataTable(file_name, export_title) {
  $.fn.dataTable.moment('DD-MM-YYYY'); //Sort the date column if present
  var table = $('#myTable').DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'print',
                exportOptions: {
                  columns: ":not(:last-child)"
                },
                title: file_name,
                messageTop: export_title
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: file_name,
                 messageTop: export_title
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: file_name,
                 messageTop: export_title
              }
          ],
          select: {
              selector:'td:not(:first-child)',
              style:    'os'
          }
    });
    // Add event listener for opening and closing details
    $('#myTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            //row.data()[2] returns order no. which is the order_id
            var link = "order_comment/" + row.data()[2];
            $.getJSON(link)
             .done( function (data) {
               row.child(format(data)).show();
               tr.addClass('shown');
             })
             .fail( function (error) {
               console.log(error);
             });
        }
    });
}

function format(obj) {
  var my_comment = "";
  if(obj.comment == null) {
    my_comment = "Order has no comment";
  } else {
    my_comment = obj.comment;
  }
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Comment:</td>'+
            '<td>'+ my_comment +'</td>'+
        '</tr>'+
    '</table>';
}
