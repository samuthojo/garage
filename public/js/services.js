var service_id = ""; //This is the Service_as_product_id

var button_txt = "";

function showServiceModal(id) {
  $('#' + id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  if(id == 'new_service') {
    clearErrors();
  }
  else if(id == 'from_existing_service') {
    clearErrors2();
  }
  else if (id == 'decision_modal') {
    $("#choice_error").text("");
  }
}

function changeStatus(id) {
  button_txt = ($("#button" + id).text()).trim();
  service_id = id;//Set global variable to be used later
  if(button_txt == "Activate") {
    showActivateModal(id);
  }
  else if(button_txt == "Deactivate") {
    showDeactivateModal(id);
  }
}

function showActivateModal(id) {
  showServiceModal('activate_modal');
}

function showDeactivateModal(id) {
  showServiceModal('deactivate_modal');
}

function updateServiceStatus(status) {
  $("#btn_modal").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var modal_id = (status == 'Active') ? 'activate_modal' : 'deactivate_modal';
  var formData = new FormData();
  formData.append('id', service_id);
  formData.append('status', status);
  var link = 'services/status/update';
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'json',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      if(result == 1) {
        $("#btn_modal").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        closeModal(modal_id);
        makeTheUpdate(status);
        if(status == "Active") {
          showMyModal('service_activate_success');
        }
        else {
          showMyModal('service_deactivate_success');
        }
      }
    }
  });
}

function makeTheUpdate(status) {
  var color = (status == "Active") ? "text-success" : "text-danger";
  $("#status" + service_id).text(status);
  $("#status" + service_id).attr("class", color);

  if(button_txt == "Activate") {
    $("#button" + service_id).text("Deactivate");
  }
  else if(button_txt == "Deactivate") {
    $("#button" + service_id).text("Activate");
  }
}

function showEditModal(service) {
  showServiceModal('edit_service_modal');
  $('#sel6').val(service.service_id);
  $('#sel7').val(service.car_id);
  $('#sel8').val(service.car_model_id);
  $('#service_price').val(service.price);
  $('#service_description').val(service.description);

  //set the service_id global
  service_id = service.id; //This is the Service_as_product_id
  clearErrors3();
}

function clearErrors() {
  $("#name_error").text("");
  $("#car_error").text("");
  $("#model_error").text("");
  $("#price_error").text("");
  $("#description_error").text("");
  $("#picture_error").text("");
}

function clearErrors2() {
  $("#service_error").text("");
  $("#car_error2").text("");
  $("#model_error2").text("");
  $("#price_error2").text("");
}

function clearErrors3() {
  $("#service_error3").text("");
  $("#car_error3").text("");
  $("#model_error3").text("");
  $("#price_error3").text("");
  $("#description_error3").text("");
  $("#picture_error3").text("");
}

function displayErrors(data) {
  if(data.name != null) {
    $("#name_error").text(data.name[0]);
  }
  if(data.car_id != null) {
    $("#car_error").text(data.car_id[0]);
  }
  if(data.car_model_id != null) {
    $("#model_error").text(data.car_model_id[0]);
  }
  if(data.price != null) {
    $("#price_error").text(data.price[0]);
  }
  if(data.description != null) {
    $("#description_error").text(data.description[0]);
  }
  if(data.picture != null) {
    $("#picture_error").text(data.picture[0]);
  }
}

function displayErrors2(data) {
  if(data.service_id != null) {
    $("#service_error").text(data.service_id[0]);
  }
  if(data.car_id != null) {
    $("#car_error2").text(data.car_id[0]);
  }
  if(data.car_model_id != null) {
    $("#model_error2").text(data.car_model_id[0]);
  }
  if(data.price != null) {
    $("#price_error2").text(data.price[0]);
  }
}

function displayErrors3(data) {
  if(data.service_id != null) {
    $("#service_error3").text(data.service_id[0]);
  }
  if(data.car_id != null) {
    $("#car_error3").text(data.car_id[0]);
  }
  if(data.car_model_id != null) {
    $("#model_error3").text(data.car_model_id[0]);
  }
  if(data.price != null) {
    $("#price_error3").text(data.price[0]);
  }
  if(data.description != null) {
    $("#description_error3").text(data.description[0]);
  }
  if(data.picture != null) {
    $("#picture_error3").text(data.picture[0]);
  }
}

function editService() {
  clearErrors3();
  $("#btn_edit").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var myForm = document.getElementById('edit_service_form');
  var formData = new FormData(myForm);
  formData.append('id', service_id); //Service_as_product_id
    var link = 'services/update';
    $.ajax({
      type: 'post',
      url: link,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
        $("#btn_edit").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        closeModal('edit_service_modal');
        $('#main_content').html(result);
        showMyModal('service_edit_success');
      },
      error: function (error) {
        $("#btn_edit").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        data = JSON.parse(error.responseText);
        displayErrors3(data.errors);
      }
    });
}

function makeDecision() {
  $("#choice_error").text("");
  var option = $('input[name=optradio]:checked', '#modal_form').val();
  if(option == 1) {
    closeModal('decision_modal');
    showServiceModal('new_service');
  } else if(option == 2) {
    closeModal('decision_modal');
    showServiceModal('from_existing_service');
  } else {
    $("#choice_error").text("Please select an option");
  }
}

function newService1() {
  clearErrors();
  $("#btn_add").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var myForm = document.getElementById('new_service_form');
  var formData = new FormData(myForm);
    var link = 'services/create';
    $.ajax({
      type: 'post',
      url: link,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
        $("#btn_add2").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        closeModal('new_service');
        $('#main_content').html(result);
        showMyModal('service_add_success');
      },
      error: function(error) {
        $("#btn_add").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        data = JSON.parse(error.responseText);
        displayErrors(data.errors);
      }
    });
}

function newService2() {
  clearErrors2();
  $("#btn_add2").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  var myForm = document.getElementById('form_from_existing');
  var formData = new FormData(myForm);
    var link = 'services/from_existing';
    $.ajax({
      type: 'post',
      url: link,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
        $("#btn_add2").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        closeModal('from_existing_service');
        $('#main_content').html(result);
        showMyModal("service_add_success");
      },
      error: function(error) {
        $("#btn_add2").prop("disabled", false);
        $(".my_loader").fadeOut(0);
        data = JSON.parse(error.responseText);
        displayErrors2(data.errors);
      }
    });
}

function viewService(id) {
  $(".loader").fadeIn(0);
  var link = "services/" + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $(".loader").fadeOut(0);
      $('#main_content').html(result);
    }
  });
}

function fetchModel(id) {
  $(".select_loader").fadeIn(0);
  var e = document.getElementById(id);
  var car_id = e.options[e.selectedIndex].value;
  var next_id = "";
  if(id == 'sel1') {
    next_id =  'sel2';
  }
  else {
    next_id = (id == 'sel4') ? 'sel5' : 'sel8';
  }
  var link = "";
  if(car_id != "") {
    link = 'models/' + car_id; //fetch all models of this make
    $.getJSON(link)
     .done(function (data) {
       setUpModels(data, next_id);
     })
     .fail(function ( error ) {
       console.error('Error', error);
     });
  }
  else {
    $(".select_loader").fadeOut(0);
    //Leave the first two options, delete the rest
    $('#' + next_id).find('option').not(':first, :eq(1)').remove();
    $('#' + next_id).val("");//select second option
  }

}

function setUpModels(models, id) {
  $(".select_loader").fadeOut(0);
  console.log('set' + id);
  var mySelect = document.getElementById(id);
  var length = mySelect.options.length;

  //Leave the first two options, delete the rest
  $('#' + id).find('option').not(':first, :eq(1)').remove();
  $('#' + id).val('#');//select first option

  for(i = 0; i < models.length; i++) {
     var opt = document.createElement("option");
     opt.value= models[i].id;
     opt.innerHTML = models[i].model_name;

     // then append it to the select element
     mySelect.appendChild(opt);
  }

}
