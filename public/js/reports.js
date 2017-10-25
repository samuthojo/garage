function fetchStatus() {
  report_type = $("#type").val();
  mySelect = document.getElementById('#status');
  status = ['Pending', 'Accepted', 'Serviced', 'Rejected', 'Rescheduled'];
  if(report_type) {
    for(i = 0; i < status.length; i++) {
      opt = document.createElement('option');
      opt.value = i;
      opt.innerHTML = status[i];
      mySelect.appendChild(opt);
    }
  }
  else {
    for(i = 0; i < (status.length - 1); i++) {
      opt = document.createElement('option');
      opt.value = i;
      opt.innerHTML = status[i];
      mySelect.appendChild(opt);
    }
  }
}

function fetchReport() {
  if(validateInput()) {

  }
}

function validateInput() {
  // type = $('type').val();
  // status = $('status').val();
  // if(type == "") {
  //   showHideAlert('report_alert');
  // }
  // else if(status == "") {
  //   showHideAlert('report_alert');
  // }

}
