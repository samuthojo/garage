var model_id = "";

function newModel(car_id) {
  $("#btn_add").prop("disabled", true);
  $(".my_loader").fadeIn(0);
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
        $("#btn_add").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        closeModal('model_modal');
        $("#main_content").html(result);
        showMyModal('model_create_success');
      },
      error: function (data) {
        $("#btn_add").prop("disabled", false);
        $(".my_loader").fadeOut(0);
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
  clearErrors3();
}

function editModel() {
  $("#btn_edit").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  clearErrors3();
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
      $("#btn_edit").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal('edit_model');
      $("#main_content").html(result);
      showMyModal('model_edit_success');
    },
    error: function (error) {
      $("#btn_edit").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      data = JSON.parse(error.responseText);
      displayErrors3(data.errors);
    }
  });
}

function clearErrors3() {
  $("#name_error2").text("");
  $("#picture_error2").text("");
}

function displayErrors3(data) {
  if(data.model_name != null) {
    $("#name_error2").text(data.model_name[0]);
  }
  if(data.picture != null) {
    $("#picture_error2").text(data.picture[0]);
  }
}

function deleteModel() {
  $("#btn_delete").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var formData = new FormData();
  formData.append('id', model_id);
  var link = "models/delete";
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      $("#btn_delete").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal('confirmation_modal');
      $("#main_content").html(result);
      showMyModal('model_delete_success');
    }
  });
}

function deleteModel2() {
  $("#btn_delete2").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var formData = new FormData();
  formData.append('id', model_id);
  var link = "models/delete";
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      $("#btn_delete2").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal('confirmation_modal');
      $("#main_content").html(result);
      showMyModal('model_delete_success');
    }
  });
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
  $(".loader").fadeIn(0);
  var link = "models/model/" + id;
  $.ajax({
      url: link,
      dataType: 'html',
      success: function (result) {
        $(".loader").fadeOut(0);
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

function showDeleteModal2(id) {
  /*set global variable*/
  model_id = id;
  $('#delete_model').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function myModelsDataTable() {
  $.fn.dataTable.moment('DD-MM-YYYY'); //Sort the date column if present
  $('#myTable').dataTable({
    iDisplayLength: 8,
    bLengthChange: false
  });
}
