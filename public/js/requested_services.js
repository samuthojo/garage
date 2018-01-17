var requested_service_id = "";

function viewCustomers(id) {
  $(".loader").fadeIn(0);
  var link = 'requested_services/' + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $(".loader").fadeOut(0);
      $('#main_content').html(result);
    }
  });
}

function openModal(id, modal_id) {
  requested_service_id = id; //set requested_service_id variable
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

function updateRequestStatus(status) {
  modal_id = getModalId(status);
  var formData = new FormData();
  formData.append('id', requested_service_id);
  formData.append('status', status);
  closeModal(modal_id);
  var link = 'requested_services/status/update';
  sendMyRequest(link, formData, status);
}

function rescheduleRequest() {
  var formData = new FormData();
  formData.append('id', requested_service_id);
  formData.append('status', 3);
  reason = $('#reason2').val();
  date = $('#date').val();
  if(date == "") {
    showHideAlert('reschedule_alert');
  } else {
    closeModal('reschedule_modal');
    $(".datepicker-container").remove();
    formData.append('date', date);
    formData.append('reason', reason);
    var link = 'requested_services/status/update';
    type = 3;
    openLoader();
    $.ajax({
      type: 'post',
      url: link,
      dataType: 'json',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        //$(".loader").fadeOut(0);
        closeLoader();
        $("#new_date" + requested_service_id).text(date);
        notifyAdmin(result, type);
      }
    });
    // sendMyRequest(link, formData, 3);
  }
}

function rejectRequest() {
  var formData = new FormData();
  formData.append('id', requested_service_id);
  formData.append('status', 4);
  reason = $('#reason').val()
  if(reason == "") {
    showHideAlert('reject_alert');
  } else {
    closeModal('reject_modal');
    formData.append('reason', reason);
    var link = 'requested_services/status/update';
    sendMyRequest(link, formData, 4);
  }
}

function sendMyRequest(link, formData, type) {
  //$(".loader").fadeIn(0);
  openLoader();
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      //$(".loader").fadeOut(0);
      closeLoader();
      notifyAdmin(result, type);
    }
  });
}

function notifyAdmin(result, type) {
  if(type == 1 || type == 3 || type == 4) {
    if(result) {
      showMyModal("notification_sent");
      makeUpdates(type);
    } else {
      showMyModal("notification_failure");
    }
  }
  else if(type == 2 && result == 1) {
    makeUpdates(type);
  }
}

function makeUpdates(type) {
  if(type == 1) {
    $("#status"+requested_service_id).text("Accepted");
    $("#status"+requested_service_id).attr("class", "text-success");
    $("#accept"+requested_service_id).attr("disabled", "disabled");
    $("#reject"+requested_service_id).attr("disabled", "disabled");
  }
  else if(type == 2) {
    $("#status"+requested_service_id).text("Serviced");
    $("#status"+requested_service_id).attr("class", "text-primary");
    $("#accept"+requested_service_id).attr("disabled", "disabled");
    $("#service"+requested_service_id).attr("disabled", "disabled");
    $("#reschedule"+requested_service_id).attr("disabled", "disabled");
    $("#reject"+requested_service_id).attr("disabled", "disabled");
    showMyModal('requested_service_alert');
  }
  else if(type == 3) {
    $("#status"+requested_service_id).text("Rescheduled");
    $("#status"+requested_service_id).attr("class", "text-info");
    $("#accept"+requested_service_id).attr("disabled", "disabled");
    $("#reject"+requested_service_id).attr("disabled", "disabled");
  }
  else if(type == 4) {
    $("#status"+requested_service_id).text("Rejected");
    $("#status"+requested_service_id).attr("class", "text-danger");
    $("#accept"+requested_service_id).attr("disabled", "disabled");
    $("#service"+requested_service_id).attr("disabled", "disabled");
    $("#reschedule"+requested_service_id).attr("disabled", "disabled");
    $("#reject"+requested_service_id).attr("disabled", "disabled");
  }
}

function getModalId(status) {
  //0: penging, 1: accepted, 2: serviced, 3: reschedule, 4: reject
  var modal_id = "";
  if(status == 1) {
    modal_id = 'accept_modal';
  } else if(status == 2) {
    modal_id = 'modal';
  } else {
    modal_id = (status == 3) ? 'reschedule_modal' : 'reject_modal';
  }
  return modal_id;
}
