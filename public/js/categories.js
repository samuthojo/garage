var category_id = "";
var category = "";

$(function() {
  $("body").on('hidden.bs.modal', '.modal', function (e) {
    $(".modal-body").find('input, textarea, select').each(function(){
       $(this).val("");
    });
    $(".modal-body").find('span').each(function(){
       $(this).fadeOut(0);
    });
  });
});

function showCategoryModal() {
  $('#category_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function newCategory() {
    var name = $('#category_name').val();
    var category = {
      'name': name
    }
    if(name == '') {
      showHideAlert('category_alert');
    } else {
      $("#btn_add").prop("disabled", true);
      $(".my_loader").fadeIn(0);
      link = "create/" + "category";
      $.ajax({
        type: 'post',
        dataType: 'html',
        url: link,
        cache: false,
        data: category,
        success: function(result) {
          $(".my_loader").fadeOut(0);
          $("#btn_add").prop("disabled", false);
          closeModal("category_modal");
          $("#main_content").html(result);
          showMyModal('add_success');
        }
      });
    }
}

function showEditModal(cat) {
  category = cat;
  $('#edit_category_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
  $("#new_name").val(category.name);
}

function editCategory() {
    var id = category.id;
    var name = $("#new_name").val();
    var datas = {
      'id': id,
      'name': name
    }
    if(name == '') {
      showHideAlert('edit_category_alert');
    } else {
      $("#btn_save").prop("disabled", true);
      $(".my_loader").fadeIn(0);
      link = "update/" + "category";
      $.ajax({
        type: 'post',
        dataType: 'html',
        url: link,
        cache: false,
        data: datas,
        success: function(result) {
          $("#btn_save").prop("disabled", false);
          $(".my_loader").fadeIn(0);
          closeModal('edit_category_modal');
          $("#main_content").html(result);
          showMyModal('edit_success');
        }
      });
    }
}

function showConfirmation(id) {
    category_id = id;
    $('#confirmation_modal').modal({
      backdrop: 'static',
      keyboard: false,
      show: true
    });
}

function deleteCategory() {
    $("#btn_delete").prop("disabled", true);
    $(".my_loader").fadeIn(0);
    var datas = {
      'id': category_id
    }
    $.ajax({
            type: 'delete',
            dataType: 'html',
            url: 'delete/category',
            cache: false,
            data: datas,
            success: function (result) {
                $(".my_loader").fadeOut(0);
                $("#btn_delete").prop("disabled", false);
                closeModal('confirmation_modal');
                $("#main_content").html(result);
                showMyModal('delete_success');
            }
    });
}
