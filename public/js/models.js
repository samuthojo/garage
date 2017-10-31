var model_id = "";

function newModel(car_id) {
  clearErrors();
  var myForm = document.getElementById('model_form');
  var formData = new FormData(myForm);
  formData.append('car_id', car_id);
  var link = "models/create";
  $.ajax({
      type: 'post',
      url: link,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        closeModal('model_modal');
        $("#main_content").html(result);
      },
      error: function (data) {
        data = JSON.parse(data.responseText);
        displayErrors(data.errors);
      }
  });
}

function clearErrors() {
  $("#name_error").text("");
  $("#picture_error").text("");
}

function displayErrors(data) {
  if(data.model_name != null) {
    $("#name_error").text(data.model_name[0]);
  }
  if(data.picture != null) {
    $("#picture_error").text(data.picture[0]);
  }
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
  clearErrors2();
}

function editModel() {
  clearErrors2();
  var myForm = document.getElementById('edit_model_form');
  var formData = new FormData(myForm);
  formData.append('id', model_id);
  var link = "models/update";
  $.ajax({
    type: 'post',
    url: link,
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      closeModal('edit_model');
      $("#main_content").html(result);
    },
    error: function (error) {
      data = JSON.parse(error.responseText);
      displayErrors2(data.errors);
    }
  });
}

function clearErrors2() {
  $("#name_error2").text("");
  $("#picture_error2").text("");
}

function displayErrors2(data) {
  if(data.model_name != null) {
    $("#name_error2").text(data.model_name[0]);
  }
  if(data.picture != null) {
    $("#picture_error2").text(data.picture[0]);
  }
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
  clearErrors();
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
