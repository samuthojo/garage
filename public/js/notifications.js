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
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData:false,
    success: function(status) {
      showAlert(status);
    }
  });
}

function showAlert(status) {
  st = status.status;
  if(st) {
    showHideAlert('notification_sent');
  } else {
    showHideAlert('notification_failure');
  }
}
