var model_id = "";

function newModel(car_id) {
  closeModal('model_modal');
  var myForm = document.getElementById('model_form');
  var formData = new FormData(myForm);
  formData.append('car_id', car_id);
  var link = "models/create";
  $.ajax({
      type: 'post',
      url: link,
      data: formData,
      dataType: 'html',
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        $("#main_content").html(result);
      }
  });
}

function showEditModel(model) {
  /*Set global variable*/
  model_id = model.id;
  $('#edit_model').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  $('#edit_car_id').val(model.car_id);
  $('#edit_model_name').val(model.model_name);
}

function editModel() {
  closeModal('edit_model');
  var myForm = document.getElementById('edit_model_form');
  var formData = new FormData(myForm);
  formData.append('id', model_id);
  var link = "models/update";
  sendRequest(link, formData);
}

function deleteModel() {
  closeModal('confirmation_modal');
  var formData = new FormData();
  formData.append('id', model_id);
  var link = "models/delete";
  sendRequest(link, formData);
}

function showModel() {
  $("#model_modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function viewModel(id) {
  var link = "models/model/" + id;
  $.ajax({
      url: link,
      dataType: 'html',
      success: function (result) {
        $("#main_content").html(result);
      }
  });
}

function showDeleteModal(id) {
  /*set global variable*/
  model_id = id;
  $('#confirmation_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}
