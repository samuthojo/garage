var customer_id = "";

function viewCustomer(id) {
  $(".loader").fadeIn(0);
  var link = 'customers/' + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $(".loader").fadeOut(0);
      $('#main_content').html(result);
    }
  });
}

function showVerificationModal(id) {
  customer_id = id; //Set global variable
  $('#verification_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function verifyCustomer() {
  $("#btn_delete").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var formData = new FormData();
  formData.append('id', customer_id);
  var link = 'customers/update';
  $.ajax({
    type: 'post',
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    url: link,
    success: function(result) {
      $("#btn_delete").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal('verification_modal');
      showMyModal('verification_success');
      if(result == 1) {
        $("#status" + customer_id).text("Yes");
        $("#status" + customer_id).attr("class", "text-success");
        $("#verify" + customer_id).prop("disabled", true);
      }
    }
  });
}
