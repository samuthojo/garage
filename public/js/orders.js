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

function acceptOrder() {
  closeModal('accept_modal');
  var link = 'orders/update';
  var formData = new FormData();
  formData.append('id', order_id);
  formData.append('status', 'accepted');
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      $('#main_content').html(result);
    }
  });
}

function rejectOrder() {
  var link = 'orders/update';
  var formData = new FormData();
  var reason = $('#reason').val();
  if(reason == "") {
    showHideAlert('reject_alert');
  } else {
    closeModal('reject_modal');
    formData.append('id', order_id);
    formData.append('status', 'rejected');
    formData.append('reason', reason); //For reject push notification purpose
    $.ajax({
      type: 'post',
      url: link,
      dataType: 'html',
      data:formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
        $('#main_content').html(result);
      }
    });
  }
}

function markAsServiced() {
  closeModal('modal');
  var link = 'orders/update';
  var formData = new FormData();
  formData.append('id', order_id);
  formData.append('status', 'serviced');
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      $('#main_content').html(result);
    }
  });
}
