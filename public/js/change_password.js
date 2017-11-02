function validateInput() {
  old_password  = $('#old_password').val();
  new_password  = $('#new_password').val();
  confirm_password  = $('#confirm_password').val();
  if(old_password == "" || new_password == "" || confirm_password == "") {
    showHideAlert('empty_fields');
  }
  else if(new_password != confirm_password) {
    showHideAlert('do_not_match');
  }
  else {
    link = 'change_password';
    myForm = document.getElementById('change_password');
    formData = new FormData(myForm);
    sendResetRequest(link, formData);
  }
}

function sendResetRequest(link, formData) {
  $("#btn_password").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (status) {
      $("#btn_password").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      feedback(status.status);
    }
  });
}

function feedback(status) {
  if(status == 1) {
    clearInput();
    showHideAlert('reset_success');
  }
  else {
    (status == 2) ? showHideAlert('wrong_old_password') :
                                    showHideAlert('do_not_match');
  }
}

function clearInput() {
  $('#old_password').val("");
  $('#new_password').val("");
  $('#confirm_password').val("");
}
