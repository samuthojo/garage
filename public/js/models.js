var model_id = "";

function newModel() {
  closeModal('model_modal');
  var myForm = document.getElementById('model_form');
  var formData = new FormData(myForm);
  var link = "models/create";
  $.ajax({
      type: 'post',
      url: link,
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
  $.ajax({
      type: 'post',
      url: link,
      dataType: 'html',
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        $("#main_content").html(result);
      }
  });
}

function deleteModel() {
  var formData = new FormData();
  formData.append('id', model_id);
  var link = "models/delete";
  $.ajax({
    url: link,
    dataType: 'html',
    cache: false,
    type: 'delete',
    data: formData,
    success: function (result) {
      $("#main_content").html(result);
    }
  });
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
