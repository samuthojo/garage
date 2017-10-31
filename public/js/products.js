var product_id = "";

function showProductModal() {
  $("#product_modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function newProduct() {
    clearErrors();
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
              closeModal('product_modal');
              $("#main_content").html(result);
            },
            error: function (error) {
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
  var link = "view/product/" + id;
  $.ajax({
    url: link,
    dataType:'html',
    success:function(result){
        $("#main_content").html(result);
    }
  });
}

function showEditProductModal(category, product, car, car_model) {
  $('#edit_product_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  $("#sel5").val(category.id);
  $("#edit_product_name").val(product.name);
  $("#sel6").val(car.id);
  $("#sel7").val(car_model.id);
  $("#edit_product_unit").val(product.unit);
  $("#edit_product_stock").val(product.stock);
  $("#edit_product_price").val(product.price);
  $('#edit_product_warranty').val(product.warranty);
  $("#sel8").val(product.has_includes);
  $("#edit_product_includes").val(product.includes);
  $("#edit_include_price").val(product.include_price);
  // $("#edit_product_file").val(product.image);
  /* set global variable product_id */
  product_id = product.id;
}

function editProduct() {
    var someDataIsMissing = false;
    var product = {
      'id': product_id,
      'category_id' : $('#sel5').val(),
      'name' : $('#edit_product_name').val(),
      'car_id': $("#sel6").val(),
      'car_model_id': $("#sel7").val(),
      'unit' : $('#edit_product_unit').val(),
      'price' : $('#edit_product_price').val(),
      'stock' : $('#edit_product_stock').val(),
      'has_includes' : $('#sel8').val(),
      'includes' : $('#edit_product_includes').val(),
      'include_price' : $('#edit_include_price').val(),
      'warranty' : $('#edit_product_warranty').val(),
      'image' : $('#edit_product_file').val()
    };
    for (var key in product) {
      if(product.key == "") {
        someDataIsMissing = true;
        break;
      }
    }
    if(someDataIsMissing) {
      showHideAlert('edit_product_alert');
    } else {
      closeModal('edit_product_modal');
      var link = 'update/product';
      var myForm = document.getElementById('edit_product_form');
      var formData = new FormData(myForm);
      formData.append('id', product_id);
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
  product_id = id;
  $('#confirmation_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function deleteProduct() {
    closeModal('confirmation_modal');
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
            $("#main_content").html(result);
        }
    });
}

function fetchModels(id) {
  var car_id = $('#' + id).val();
  var link = 'models/' + car_id; //fetch all models of this make
  $.getJSON(link)
   .done(function (data) {
     next_id = (id == 'sel2') ? 'sel3' : 'sel7';
     setUpModels(data, next_id);
   })
   .fail(function ( error ) {
     console.error('Error', error);
   });
}

function setUpModels(models, id) {
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
