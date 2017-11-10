var my_car_id = "";

function showCarModal() {
  $("#car_modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  clearErrors();
}

function newCar() {
    clearErrors();
    $("#btn_add").prop("disabled", true);
    $(".my_loader").fadeIn(0);
    var link = 'cars/create';
    var myForm = document.getElementById("car_form");
    var formData = new FormData(myForm);
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
                closeModal('car_modal');
                $("#main_content").html(result);
                showMyModal('car_create_success');
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
  $("#car_name_error").text("");
  $("#num_models_error").text("");
  $("#image_error").text("");
}

function displayErrors(data) {
  if(data.name != null) {
    $("#car_name_error").text(data.name[0]);
  }
  if(data.num_models != null) {
    $("#num_models_error").text(data.num_models[0]);
  }
  if(data.picture != null) {
    $("#image_error").text(data.picture[0]);
  }
}

function viewCar(id) {
  $(".loader").fadeIn(0);
  var link = "view/car/" + id;
  $.ajax({
    url: link,
    dataType:'html',
    success:function(result){
        $(".loader").fadeOut(0);
        $("#main_content").html(result);
    }
  });
}

function showEditCarModal(car, location) {
  our_location = location;
  /*Set global variable*/
  my_car_id = car.id;
  $('#edit_car_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  clearErrors2();
  $('#edit_car_name').val(car.name);
  $('#edit_car_models').val(car.num_models);
}

function editCar() {
  $("#edit_btn_add").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  clearErrors2();
  var myForm = document.getElementById('edit_car_form');
  var formData = new FormData(myForm);
  formData.append('id', my_car_id);
    var link = 'cars/update/' + our_location;
    $.ajax({
            type: 'post',
            url: link,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
              $("#edit_btn_add").prop("disabled", false);
              $(".my_loader").fadeOut(0);
              closeModal('edit_car_modal');
              $("#main_content").html(result);
              showMyModal('car_edit_success');
            },
            error: function (data) {
              $("#edit_btn_add").prop("disabled", false);
              $(".my_loader").fadeOut(0);
              data = JSON.parse(data.responseText);
              displayErrors2(data.errors);
            }
    });
}

function clearErrors2() {
  $("#car_name_error2").text("");
  $("#num_models_error2").text("");
  $("#image_error2").text("");
}

function displayErrors2(data) {
  if(data.name != null) {
    $("#car_name_error2").text(data.name[0]);
  }
  if(data.num_models != null) {
    $("#num_models_error2").text(data.num_models[0]);
  }
  if(data.picture != null) {
    $("#image_error2").text(data.picture[0]);
  }
}

function showCarDeleteModal(id) {
  /*set global variable*/
  my_car_id = id;
  $('#car_confirmation_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function deleteCar() {
    $("#btn_delete").prop("disabled", true);
    $(".my_loader").fadeIn(0);
    var id = {
      'id' : my_car_id
    };
    var link = 'delete/car';
    $.ajax({
        type: 'delete',
        dataType: 'html',
        url: link,
        cache: false,
        data: id,
        success: function (result) {
            $("#btn_delete").prop("disabled", false);
            $(".my_loader").fadeOut(0);
            closeModal('confirmation_modal');
            $("#main_content").html(result);
            showMyModal('car_delete_success');
        }
    });
}

function viewModels(id) {
  $(".loader").fadeIn(0);
  var link = 'models/view/' + id; //fetch all models of this make
  $.ajax({
        url: link,
        dataType: 'html',
        success: function (result) {
          $(".loader").fadeOut(0);
          $("#main_content").html(result);
        }
  });
}
