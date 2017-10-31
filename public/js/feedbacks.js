var feedback_id = "";

function readFeedback(id) {
  link = "feedback/" + id;
  $.ajax({
    url: link,
    dataType: 'html',
    success: function(result) {
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
  closeModal('confirmation_modal');
  link = 'feedback/delete';
  $.ajax({
    type: 'post',
    url: link,
    dataType: 'html',
    data: {'id' : feedback_id},
    success: function(data) {
      $("#main_content").html(data);
    }
  });
}
