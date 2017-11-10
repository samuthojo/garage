var product_id = "";

function fetchParticulars(id) {
  $(".loader").fadeIn(0);
  //models //category //product //car //car_model
  var link = "product_particulars/" + id;
  $.getJSON(link)
   .done( function(data) {
     if(data.models != null) {
       appendModels(data.models, "sel7");
     }
     $(".loader").fadeOut(0);
     showEditProductModal(data.category, data.product,
                          data.car, data.car_model, "products");
   })
   .fail( function(error) {
     console.log(error);
   });
}

function appendModels(models, id) {
  var mySelect = document.getElementById(id);

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

function showProductModal() {
  $("#product_modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  clearErrors();
  $("#my_includes").fadeOut(0);
}

function newProduct() {
    clearErrors();
    $("#btn_add").prop("disabled", true);
    $(".my_loader").fadeIn(0);
    var link = 'products/create';
    var myForm = document.getElementById('product_form');
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
              closeModal('product_modal');
              $("#main_content").html(result);
              showMyModal('product_success');
            },
            error: function (error) {
              $("#btn_add").prop("disabled", false);
              $(".my_loader").fadeOut(0);
              data = JSON.parse(error.responseText);
              $("#error_notifier").text("Please solve above errors");
              displayErrors(data.errors);
            }
    });
}

function clearErrors() {
  $("#error_notifier").text("");
  $("#category_error").text("");
  $("#name_error").text("");
  $("#car_error").text("");
  $("#model_error").text("");
  $("#unit_error").text("");
  $("#stock_error").text("");
  $("#price_error").text("");
  $("#warranty_error").text("");
  $("#has_includes_error").text("");
  $("#includes_error").text("");
  $("#include_price_error").text("");
  $("#image_error").text("");
}

function displayErrors(data) {
  if(data.category_id != null) {
    $("#category_error").text(data.category_id[0]);
  }
  if(data.name != null) {
    $("#name_error").text(data.name[0]);
  }
  if(data.car_id != null) {
    $("#car_error").text(data.car_id[0]);
  }
  if(data.car_model_id != null) {
    $("#model_error").text(data.car_model_id[0]);
  }
  if(data.unit != null) {
    $("#unit_error").text(data.unit[0]);
  }
  if(data.stock != null) {
    $("#stock_error").text(data.stock[0]);
  }
  if(data.price != null) {
    $("#price_error").text(data.price[0]);
  }
  if(data.warranty != null) {
    $("#warranty_error").text(data.warranty[0]);
  }
  if(data.has_includes != null) {
    $("#has_includes_error").text(data.has_includes[0]);
  }
  if(data.includes != null) {
    $("#includes_error").text(data.includes[0]);
  }
  if(data.include_price != null) {
    $("#include_price_error").text(data.include_price[0]);
  }
  if(data.image != null) {
    $("#image_error").text(data.image[0]);
  }
}

function viewProduct(id) {
  $(".loader").fadeIn(0);
  var link = "view/product/" + id;
  $.ajax({
    url: link,
    dataType:'html',
    success:function(result){
        $(".loader").fadeOut(0);
        $("#main_content").html(result);
    }
  });
}

function showEditProductModal(category, product, car, car_model, location) {
  our_location = location;
  $('#edit_product_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  $("#my_includes2").fadeOut(0);
  clearErrors2();
  $("#sel5").val(category.id);
  $("#edit_product_name").val(product.name);
  $("#sel6").val(car.id);
  $("#sel7").val(car_model.id);
  $("#edit_product_unit").val(product.unit);
  $("#edit_product_stock").val(product.stock);
  $("#edit_product_price").val(product.price);
  $('#edit_product_warranty').val(product.warranty);
  $("#sel8").val(product.has_includes);
  
  if(parseInt(product.has_includes)) {
    $("#edit_product_includes").val(product.includes);
    $("#edit_include_price").val(product.include_price);
    $("#my_includes2").fadeIn(0);
  }
  // $("#edit_product_file").val(product.image);
  /* set global variable product_id */
  product_id = product.id;
}

function editProduct() {
      clearErrors2();
      $("#btn_save").prop("disabled", true);
      $(".my_loader").fadeIn(0);
      var link = 'products/update/' + our_location;
      var myForm = document.getElementById('edit_product_form');
      var formData = new FormData(myForm);
      formData.append('id', product_id);
      $.ajax({
              type: 'post',
              url: link,
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function (result) {
                  $("#btn_save").prop("disabled", false);
                  $(".my_loader").fadeOut(0);
                  closeModal('edit_product_modal');
                  $("#main_content").html(result);
                  showMyModal("product_edit_success");
              },
              error: function (error) {
                $("#btn_save").prop("disabled", false);
                $(".my_loader").fadeOut(0);
                data = JSON.parse(error.responseText);
                $("#error_notifier2").text("Please solve above errors");
                displayErrors2(data.errors);
              }
      });
}

function clearErrors2() {
  $("#error_notifier2").text("");
  $("#category_error2").text("");
  $("#name_error2").text("");
  $("#car_error2").text("");
  $("#model_error2").text("");
  $("#unit_error2").text("");
  $("#stock_error2").text("");
  $("#price_error2").text("");
  $("#warranty_error2").text("");
  $("#has_includes_error2").text("");
  $("#includes_error2").text("");
  $("#include_price_error2").text("");
  $("#image_error2").text("");
}

function displayErrors2(data) {
  if(data.category_id != null) {
    $("#category_error2").text(data.category_id[0]);
  }
  if(data.name != null) {
    $("#name_error2").text(data.name[0]);
  }
  if(data.car_id != null) {
    $("#car_error2").text(data.car_id[0]);
  }
  if(data.car_model_id != null) {
    $("#model_error2").text(data.car_model_id[0]);
  }
  if(data.unit != null) {
    $("#unit_error2").text(data.unit[0]);
  }
  if(data.stock != null) {
    $("#stock_error2").text(data.stock[0]);
  }
  if(data.price != null) {
    $("#price_error2").text(data.price[0]);
  }
  if(data.warranty != null) {
    $("#warranty_error2").text(data.warranty[0]);
  }
  if(data.has_includes != null) {
    $("#has_includes_error2").text(data.has_includes[0]);
  }
  if(data.includes != null) {
    $("#includes_error2").text(data.includes[0]);
  }
  if(data.include_price != null) {
    $("#include_price_error2").text(data.include_price[0]);
  }
  if(data.image != null) {
    $("#image_error2").text(data.image[0]);
  }
}

function showDeleteModal(id) {
  /*set global variable*/
  product_id = id;
  $('#confirmation_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function deleteProduct() {
    $("#btn_delete").prop("disabled", true);
    $(".my_loader").fadeIn(0);
    var id = {
      'id' : product_id
    };
    var link = 'delete/product';
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
            showMyModal("product_delete_success");
        }
    });
}

function fetchModels(id) {
  $(".select_loader").fadeIn(0);
  var car_id = $('#' + id).val();
  var next_id = (id == 'sel2') ? 'sel3' : 'sel7';
  if(car_id != "") {
    var link = 'models/' + car_id; //fetch all models of this make
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
    var mySelect = document.getElementById(id);

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

function bringIncludes(id) {
  var id1 = id2 = id3 = "";
  if(id == "sel4") {
    id1 = "#my_includes";
    id2 = "#product_includes";
    id3 = "#include_price";
  }
  else if(id == "sel8") {
    id1 = "#my_includes2";
    id2 = "#edit_product_includes";
    id3 = "#edit_include_price";
  }
  var has_includes = parseInt($("#" + id).val());
  if(has_includes) {
    $(id1).fadeIn(0);
  }
  else {
    $(id2).val("");
    $(id3).val("");
    $(id1).fadeOut(0);
  }
}
