var activeEl = null;
var previousEl = null;

$(document).ready(function() {
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode: {
      401: function() {
        window.location.href = "admin";
    },
      419: function() {
        window.location.href = "admin";
    }
  }
 });

  previousEl = $('#categories');
  var cols = document.querySelectorAll('#link_section .link');
	[].forEach.call(cols, function(col) {
    col.addEventListener('click', setActive, false);
  });
});

function setActive(e) {
  (previousEl != null) ? previousEl.removeClass('active') : "";
  if(previousEl != null) {
    previousEl.removeClass('active');
    this.classList.add('active');
    activeEl = this;
    previousEl = null;
  } else {
    activeEl.classList.remove('active');
    this.classList.add('active');
    activeEl = this;
  }

}

function myDataTable(file_name, export_title) {
  $.fn.dataTable.moment('DD-MM-YYYY'); //Sort the date column if present
  $('#myTable').dataTable({
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
          bLengthChange: false
    });
}

function menu_links(arg) {
    $(".loader").fadeIn(0);
    var link = "";
    if(arg == "categories") {
      link = "categories";
    }
    else if(arg == "products"){
      link = "products";
    }
    else if(arg == "cars"){
      link = "cars";
    }
    else if(arg == "customers"){
      link = "customers";
    }
    else if(arg == "orders"){
      link = "orders";
    }
    else if(arg == "requested_services"){
      link = "requested_services";
    }
   else if(arg == "services"){
     link = "services";
    }
   else if(arg == "change_password"){
     link = "change_password_form";
     removeClassActive();
   }
   else if(arg == "reports"){
     link = "reports";
   }
   else if(arg == "notifications"){
     link = "notifications";
     removeClassActive();
   }
   else if(arg == "promo_messages") {
     link = "promo_messages";
     removeClassActive();
   }
   else if(arg == "feedbacks") {
     link = "feedbacks";
     removeClassActive();
   }
   $.ajax({
     url: link,
     dataType: 'html',
     success: function(result) {
         $(".loader").fadeOut(0);
         $("#main_content").html(result);
     }
   });
}

function removeClassActive() {
  var cols = document.querySelectorAll('#link_section .link');
    [].forEach.call(cols, function (col) {
    col.classList.remove('active');
  });
}

function showMyModal(modal_id) {
  $('#' + modal_id).modal({
    show: true
  });
}

function showHideAlert(id) {
  $("#" + id).fadeTo(2000, 500).slideUp(500, function(){
    $("#" + id).slideUp(500);
  });
}

function closeModal(id) {
  $("#" + id).modal('hide');
  $('body').removeClass("modal-open");
  $('body').removeAttr('style');
  $(".modal-backdrop").remove();
}

function sendRequest(link, formData) {
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      $("#main_content").html(result);
    }
  });
}
