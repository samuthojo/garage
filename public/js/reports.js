var report_type = "";
var my_status = "";
var start_date = "";
var end_date = "";
var today_date = formatDate(new Date());

function fetchStatus(order_date, request_date) {
  report_type = parseInt($("#type").val());
  mySelect = document.getElementById('status');
  myStatus = ["Pending", "Accepted", "Serviced", "Rejected", "Rescheduled"];
  if(report_type) {
    $("#status").find("option").not(":first").remove();
    for(let i = 0; i < myStatus.length; i++) {
      var opt = document.createElement("option");
      opt.value = i;
      opt.innerHTML = myStatus[i];
      mySelect.appendChild(opt);
    }
    $("#start_date").val(request_date);
  }
  else {
    $("#status").find("option").not(":first").remove();
    for(let i = 0; i < (myStatus.length - 1); i++) {
      var opt = document.createElement("option");
      opt.value = i;
      opt.innerHTML = myStatus[i];
      mySelect.appendChild(opt);
    }
    $("#start_date").val(order_date);
  }
}

function fetchReport() {
  if(validateInput()) {
    postMyData();
  }
}

function validateInput() {
  report_type = $('#type').val();
  my_status = $('#status').val();
  start_date = $("#start_date").val();
  end_date = $("#end_date").val();
  if(report_type == null || my_status == null) {
    showHideAlert('report_alert');
    return false;
  }
  else if(end_date != "" && start_date == "") {
    showHideAlert('report_alert2');
    return false;
  }
  return true;
}

function postMyData() {
  $("#btn_submit").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var link = "";
  if(report_type == 1) {
    link = "reports/requested_services";
  }
  else {
    link = "reports/orders";
  }
  start_date = $("#start_date").val();
  end_date = $("#end_date").val();
  my_status = parseInt($("#status").val());
  formData = new FormData();
  formData.append('start_date', start_date);
  formData.append('end_date', end_date);
  formData.append('status', my_status);
  $.ajax({
    url: link,
    type: 'post',
    data: formData,
    dataType: 'html',
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      $("#btn_submit").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      $("#report_area").html(result);
    }
  });
}

function niceTitle() {
  if(report_type != "" && my_status != "" &&
            start_date != "" && end_date != "") {
      return "All " + niceString("status") + " " + niceString("report") +
             " from: " + start_date + " to: " + end_date;
  }

  else if(report_type != "" && my_status != "" &&
            start_date != "") {
      return "All " + niceString("status") + " " + niceString("report") +
             " from: " + start_date;
  }

  else if(report_type != "" && my_status != "") {
      return "All " + niceString("status") + " " + niceString("report") +
             " As printed on: " + today_date;
  }

}

function niceString(item) {
  if(item == "status") {
    return statusString();
  }
  else if(item == "report") {
    return reportString();
  }
}

function statusString() {
  if(my_status == 0) {
    return "Pending";
  }
  else if(my_status == 1) {
    return "Accepted";
  }
  else if (my_status == 2) {
    return "Serviced";
  }
  else if (my_status == 3) {
    return "Rejected";
  }
  else if(my_status == 4) {
    return "Rescheduled";
  }
}

function reportString() {
  if(report_type == 0) {
    return "Orders";
  }
  else if(report_type == 1) {
    return "Requested Services";
  }
}

function formatDate(date) {
  var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function myReportDataTable(file_name, export_title) {
  $.fn.dataTable.moment('DD-MM-YYYY'); //Sort the date column if present
  $('#myTable').dataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'print',
                title: file_name,
                messageTop: export_title
              },
               {
                 extend: 'excel',
                 title: file_name,
                 messageTop: export_title
              },
               {
                 extend: 'pdf',
                 title: file_name,
                 messageTop: export_title
              }
          ],
          iDisplayLength: 8
    });
}
