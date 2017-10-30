var car_id = "";

function showCarModal() {
  $("#car_modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function newCar() {
  var someDataIsMissing = false;
  var myForm = document.getElementById('car_form');
  var formData = new FormData(myForm);
  for (var key in formData) {
    if(formData.key == "") {
      someDataIsMissing = true;
      break;
    }
  }
  if(someDataIsMissing) {
    showHideAlert('car_alert');
  } else {
    closeModal('car_modal');
    var link = 'create/car';
    $.ajax({
            type: 'post',
            dataType: 'html',
            url: link,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                $("#main_content").html(result);
            }
    });
  }
}


function viewCar(id) {
  var link = "view/car/" + id;
  $.ajax({
    url: link,
    dataType:'html',
    success:function(result){
        $("#main_content").html(result);
    }
  });
}

function showEditCarModal(car) {
  /*Set global variable*/
  car_id = car.id;
  $('#edit_car_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  $('#edit_car_name').val(car.name);
  $('#edit_car_models').val(car.num_models);
}

function editCar() {
  var someDataIsMissing = false;
  var myForm = document.getElementById('edit_car_form');
  var formData = new FormData(myForm);
  formData.append('id', car_id);
  for (var key in formData) {
    if(formData.key == "") {
      someDataIsMissing = true;
      break;
    }
  }
  if(someDataIsMissing) {
    showHideAlert('edit_car_alert');
  } else {
    closeModal('edit_car_modal');
    var link = 'update/car';
    $.ajax({
            type: 'post',
            dataType: 'html',
            url: link,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                $("#main_content").html(result);
            }
    });
  }
}

function showDeleteModal(id) {
  /*set global variable*/
  car_id = id;
  $('#confirmation_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function deleteCar() {
    closeModal('confirmation_modal');
    var id = {
      'id' : car_id
    };
    var link = 'delete/car';
    $.ajax({
        type: 'delete',
        dataType: 'html',
        url: link,
        cache: false,
        data: id,
        success: function (result) {
            $("#main_content").html(result);
        }
    });
}

function viewModels(id) {
  var link = 'models/view/' + id; //fetch all models of this make
  $.ajax({
        url: link,
        dataType: 'html',
        success: function (result) {
          $("#main_content").html(result);
        }
  });
}
