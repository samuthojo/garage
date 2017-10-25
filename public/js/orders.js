var order_id = "";

function viewItems(id) {
  var link = 'orders/' + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $('#main_content').html(result);
    }
  });
}

function openModal(id, modal_id) {
  order_id = id; //set order_id variable
  $('#' + modal_id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function showMyModal(modal_id) {
  $('#' + modal_id).modal({
    show: true
  });
}

function openLoader() {
  $('#modal_loader').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function closeLoader() {
  closeModal('modal_loader');
}

function acceptOrder() {
  closeModal('accept_modal');
  //$(".loader").fadeIn(0);
  openLoader();
  var link = 'orders/update';
  var formData = new FormData();
  formData.append('id', order_id);
  formData.append('status', 'accepted');
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(status) {
      //$(".loader").fadeOut(0);
      closeLoader();
      notifyAccepted(status);
    }
  });
}

function notifyAccepted(status) {
  if(status) {
    showMyModal('notification_sent');
    $("#status" + order_id).text("Accepted");
    $("#status" + order_id).attr("class", "text-success");
    $("#accept" + order_id).attr("disabled", "disabled");
    $("#reject" + order_id).attr("disabled", "disabled");
  } else {
    showMyModal('notification_failure');
  }
}

function rejectOrder() {
  var link = 'orders/update';
  var formData = new FormData();
  var reason = $('#reason').val();
  if(reason == "") {
    showHideAlert('reject_alert');
  } else {
    closeModal('reject_modal');
    //$(".loader").fadeIn(0);
    openLoader();
    formData.append('id', order_id);
    formData.append('status', 'rejected');
    formData.append('reason', reason); //For reject push notification purpose
    $.ajax({
      type: 'post',
      url: link,
      dataType: 'json',
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(status) {
        closeLoader();
        notifyRejected(status);
      }
    });
  }
}

function notifyRejected(status) {
  if(status) {
    showMyModal('notification_sent');
    $("#status" + order_id).text("Rejected");
    $("#status" + order_id).attr("class", "text-danger");
    $("#accept" + order_id).attr("disabled", "disabled");
    $("#service" + order_id).attr("disabled", "disabled");
    $("#reject" + order_id).attr("disabled", "disabled");
  } else {
    showMyModal('notification_failure');
  }
}

function markAsServiced() {
  closeModal('modal');
  //$(".loader").fadeIn(0);
  openLoader();
  var link = 'orders/update';
  var formData = new FormData();
  formData.append('id', order_id);
  formData.append('status', 'serviced');
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(status) {
      closeLoader();
      notifyServiced(status);
    }
  });
}

function notifyServiced(status) {
  if(status) {
    $("#status" + order_id).text("Serviced");
    $("#status" + order_id).attr("class", "text-primary");
    $("#accept" + order_id).attr("disabled", "disabled");
    $("#service" + order_id).attr("disabled", "disabled");
    $("#reject" + order_id).attr("disabled", "disabled");
    showMyModal('order_alert');
  }
}
