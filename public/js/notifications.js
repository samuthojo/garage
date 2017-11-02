function verifyInput() {
  type = $('#notification_type').val();

  if(type == "" || type == null) {
    showHideAlert('notification_alert');
  } else {
    formData = new FormData();
    formData.append('type', type);
    link = 'notifications/send';
    sendNotificationRequest(link, formData);
  }
}

function sendNotificationRequest(link, formData) {
  $(".loader").fadeIn(0);
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData:false,
    success: function(status) {
      $(".loader").fadeOut(0);
      $("#notification_type").val(null);
      showAlert(status);
    }
  });
}

function showAlert(status) {
  if(status) {
    showHideAlert('notification_sent');
  } else {
    showHideAlert('notification_failure');
  }
}
