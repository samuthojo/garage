var customer_id = "";

function viewCustomer(id) {
  var link = 'customers/' + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
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
  closeModal('verification_modal');
  var formData = new FormData();

  formData.append('id', customer_id);

  var link = 'customers/update';
  $.ajax({
    type: 'post',
    dataType: 'html',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    url: link,
    success: function(result) {
      $('#main_content').html(result);
    }
  });
}
