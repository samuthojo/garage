var feedback_id = "";

function readFeedback(id) {
  $(".loader").fadeIn(0);
  link = "feedback/" + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
      $(".loader").fadeOut(0);
      $("#main_content").html(result);
    }
  })
}

function deleteModal(id) {
  feedback_id = id;
  $('#confirmation_modal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function deleteFeedback() {
  $("#btn_delete").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  link = 'feedback/delete';
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: {'id' : feedback_id},
    success: function(data) {
      $("#btn_delete").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      closeModal('confirmation_modal');
      $("#main_content").html(data);
      showMyModal('feedback_delete_success');
    }
  });
}
