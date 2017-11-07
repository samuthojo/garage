function myRequestsDataTable(file_name, export_title) {
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
          iDisplayLength: 8,
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
            //row.data()[1] returns request_id
            var link = "request_details/" + row.data()[1];
            $.getJSON(link)
             .done( function (data) {
               row.child.hide();
               tr.removeClass('shown');
               row.child(format(data.service)).show();
               tr.addClass('shown');
             })
             .fail( function (error) {
               console.log(error);
             });
             row.child(format2()).show();
             tr.addClass('shown');
        }
    });
}

function format(obj) {
  if(obj.pick_option == 0) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Customer Descriptions:</th>'+
            '<td>'+ obj.description +'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>Staff Comment:</th>'+
          '<td>' + obj.comment +'</td>'+
        '</tr>'+
        '<tr>'+
            '<th>Pick-Option:</th>'+
            '<td>'+ pickOptionString(obj.pick_option) +'</td>'+
        '</tr>' +
    '</table>';
  }
  else if(obj.pick_option == 1){
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
          '<tr>'+
              '<th>Customer Descriptions:</th>'+
              '<td>'+ obj.description +'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Staff Comment:</th>'+
            '<td>' + obj.comment +'</td>'+
          '</tr>'+
          '<tr>'+
              '<th>Pick-Option:</th>'+
              '<td>'+ pickOptionString(obj.pick_option) +'</td>'+
          '</tr>'+ '<tr>'+
               '<th>Latitude:</th>'+
               '<td>'+ obj.latitude +'</td>'+
               '<th>Longitude:</th>'+
               '<td>'+ obj.longitude +'</td>'+
               '<th>Location Name:</th>'+
               '<td>'+ obj.location_name +'</td>'+
             '</tr>' +
      '</table>';
  }
}

function pickOptionString(value) {
  if(value == 0) {
    return "I will bring it."
  }
  else if(value == 1) {
    return "Come to take it."
  }
}

function format2() {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>'+ '<span>' +
            'Fetching...' +
            '</span>' + '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"></i>' +
            '</td>'+
        '</tr>'+
    '</table>';
}
