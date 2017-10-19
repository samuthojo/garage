var activeEl = null;
var previousEl = null;

$(document).ready(function() {
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

function myDataTable() {
  $.fn.dataTable.moment('DD-MM-YYYY'); //Sort the date column if present
  $('#myTable').dataTable({
          iDisplayLength: 8,
          oLanguage: {
              sSearch: 'search:',
              sZeroRecords: 'No  results found ',
              oPaginate: {
                  sNext: '<i class="fa fa-arrow-right"></i>',
                  sPrevious: '<i class="fa fa-arrow-left"></i>'
              }
          },
          bLengthChange: false,
          sDom: "<'row-fluid' <'span4'l> <'span8'f> > rt <'row-fluid' <'span12'p> >"
      });
  $('#exampleDT_length select').select2({
      minimumResultsForSearch: 6,
      width: "off"
  });
}

function menu_links(arg) {
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
    else if(arg == "models"){
      link = "models";
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
     link = "change_password";
   }
   $.ajax({
     url: link,
     dataType:'html',
     success:function(result){
         $("#main_content").html(result);
     }
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
