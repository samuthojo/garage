var requested_service_id = "";

function viewCustomers(id) {
  var link = 'requested_services/' + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $('#main_content').html(result);
    }
  });
}

function openModal(id, modal_id) {
  console.log(id);
  requested_service_id = id; //set requested_service_id variable
  console.log(requested_service_id);
  $('#' + modal_id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function updateRequestStatus(status) {
  modal_id = getModalId(status);
  var formData = new FormData();
  formData.append('id', requested_service_id);
  formData.append('status', status);
  closeModal(modal_id);
  var link = 'requested_services/status/update';
  sendRequest(link, formData);
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
    formData.append('date', date);
    formData.append('reason', reason);
    var link = 'requested_services/status/update';
    sendRequest(link, formData);
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
    sendRequest(link, formData);
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
