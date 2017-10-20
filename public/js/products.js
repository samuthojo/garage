var product_id = "";

function showProductModal() {
  $("#product_modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function newProduct() {
  var someDataIsMissing = false;
  var product = {
    'category_id' : $('#sel1').val(),
    'name': $("#product_name").val(),
    'car_id' : $('#sel2').val(),
    'car_model_id' : $('#sel3').val(),
    'unit': $("#product_unit").val(),
    'price': $("#product_price").val(),
    'stock': $("#product_stock").val(),
    'warranty': $('#product_warranty').val(),
    'has_includes': $("#sel4").val(),
    'includes': $("#product_includes").val(),
    'include_price': $("#include_price").val(),
    'image': $("#product_file").val()
  };
  for (var key in product) {
    if(product.key == "") {
      someDataIsMissing = true;
      break;
    }
  }
  if(someDataIsMissing) {
    showHideAlert('product_alert');
  } else {
    closeModal('product_modal');
    var link = 'create/product';
    var myForm = document.getElementById('product_form');
    var formData = new FormData(myForm);
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
