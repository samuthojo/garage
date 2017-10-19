var service_id = ""; //This is the Service_as_product_id

function showServiceModal(id) {
  $('#' + id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function showActivateModal(id) {
  service_id = id;
  showServiceModal('activate_modal');
}

function showDeactivateModal(id) {
  service_id = id;
  showServiceModal('deactivate_modal');
}

function updateServiceStatus(status) {
  var modal_id = (status == 'Active') ? 'activate_modal' : 'deactivate_modal';
  closeModal(modal_id);
  var formData = new FormData();
  formData.append('id', service_id);
  formData.append('status', status);
  var link = 'services/status/update';
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (result) {
      $("#main_content").html(result);
    }
  });
}

function showEditModal(service) {
  showServiceModal('edit_service_modal');
  $('#sel1').val(service.service_id);
  $('#sel2').val(service.car_id);
  $('#sel3').val(service.car_model_id);
  $('#service_price').val(service.price);
  $('#service_description').val(service.description);

  //set the service_id global
  service_id = service.id; //This is the Service_as_product_id
}

function editService() {
  var myForm = document.getElementById('edit_service_form');
  var formData = new FormData(myForm);
  formData.append('id', service_id); //Service_as_product_id
  //To do: ensure no field is empty
  var someDataIsMissing = false;
  if(someDataIsMissing) {
    showHideAlert('service_alert');
  } else {
    closeModal('edit_service_modal');
    var link = 'services/update';
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
}

function showDeleteModal(id) {
  service_id = id;
  showServiceModal('confirmation_modal');
}

function deleteService() {
  closeModal('confirmation_modal');
  var datas = {
    'id' : service_id
  };gar
  var link = 'delete/service';
  $.ajax({
      type: 'delete',
      dataType: 'html',
      url: link,
      cache: false,
      data: datas,
      success: function (result) {
          $("#main_content").html(result);
      }
  });
}

function makeDecision() {
  var option = $('input[name=optradio]:checked', '#modal_form').val();

  closeModal('decision_modal');

  if(option == 1) {
    showServiceModal('new_service');
  } else {
    showServiceModal('from_existing_service');
  }
}

function newService1() {
  var myForm = document.getElementById('new_service_form');
  var formData = new FormData(myForm);
  //To do: ensure no field is empty
  var someDataIsMissing = false;
  if(someDataIsMissing) {
    showHideAlert('service_alert');
  } else {
    closeModal('new_service');
    var link = 'services/create';
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
}

function newService2() {
  var myForm = document.getElementById('form_from_existing');
  var formData = new FormData(myForm);
  //To do: ensure no field is empty
  var someDataIsMissing = false;
  if(someDataIsMissing) {
    showHideAlert('service_alert');
  } else {
    closeModal('from_existing_service');
    var link = 'services/from_existing';
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
}

function viewService(id) {
  var link = "services/" + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $('#main_content').html(result);
    }
  });
}

function fetchModel(id) {
  var e = document.getElementById(id);
  var car_id = e.options[e.selectedIndex].value;
  var link = 'models/' + car_id; //fetch all models of this make

  $.getJSON(link)
   .done(function (data) {
     var next_id = "";
     if(id == 'sel1') {
       next_id =  'sel2';
     } else {
       next_id = (id == 'sel2') ? 'sel3' : 'sel5';
      }
     setUpModels(data, next_id);
   })
   .fail(function ( error ) {
     console.error('Error', error);
   });
}

function setUpModels(models, id) {
  var mySelect = document.getElementById(id);
  var length = mySelect.options.length;

  //Leave the first two options, start at i = 2
  for (i = 2; i < length; i++) {
    mySelect.options[i] = null;
  }

  for(i = 0; i < models.length; i++) {
     var opt = document.createElement("option");
     opt.value= models[i].id;
     opt.innerHTML = models[i].model_name;

     // then append it to the select element
     mySelect.appendChild(opt);
  }

}
