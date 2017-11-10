var activeTab = null;
var previousTab = null;
var locationPromo = "";

$(document).ready(function() {
  previousTab = $('#order_promo');
  locationPromo = 0; //OrderPromoMessage Is Active
  var cols = document.querySelectorAll('#promo .my_link');
	[].forEach.call(cols, function(col) {
    col.addEventListener('click', setTabActive, false);
  });
});

function setTabActive(e) {
  (previousTab != null) ? previousTab.removeClass('active') : "";
  if(previousTab != null) {
    previousTab.removeClass('active');
    this.classList.add('active');
    activeTab = this;
    previousTab = null;
  } else {
    activeTab.classList.remove('active');
    this.classList.add('active');
    activeTab = this;
  }
}

function orderPromo() {
  $(".loader").fadeIn(0);
  locationPromo = 0 //OrderPromoMessage Is Active
  var link = "order_promo";
  $.getJSON(link)
    .done( function(data) {
      $(".loader").fadeOut(0);
      $("#promo_text").text(data.order_promo.message);
    })
    .fail( function(error) {
      console.log(error);
    });
}

function servicePromo() {
  $(".loader").fadeIn(0);
  locationPromo = 1 //ServicePromoMessage Is Active
  var link = "service_promo";
  $.getJSON(link)
    .done( function(data) {
      $(".loader").fadeOut(0);
      $("#promo_text").text(data.service_promo.message);
    })
    .fail( function(error) {
      console.log(error);
    });
}

function openModal() {
  id = getModalId(locationPromo);
  $('#' + id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function getModalId(locationPromo) {
  if(locationPromo == 1) {
    return "service_promo_modal";
  }
  else if (locationPromo == 0) {
    return "order_promo_modal";
  }
}

function savePromo(promo_id) {
  $("#btn_modal").prop("disabled", true);
  $(".my_loader").fadeIn(0);
  link = getPromoLink(locationPromo, promo_id);
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: link,
    data: {
      'message' : $(getTextId(locationPromo)).val()
    },
    cache: false,
    success: function (data) {
      $("#btn_modal").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      $(getErrorId(locationPromo)).text("");
      closeModal(getModalId(locationPromo));
      $("#promo_text").text(data.promo.message);
      showMyModal('promo_edit_success');
    },
    error: function(error) {
      $("#btn_modal").prop("disabled", false);
      $(".my_loader").fadeOut(0);
      data = JSON.parse(error.responseText);
      $(getErrorId(locationPromo)).text(data.errors.message[0]);
    }
  });
}

function getPromoLink(locationPromo, id) {
  link = "";
  if(locationPromo == 1) {
    link = "service_promos/" + id;
  }
  else if (locationPromo == 0) {
    link = "order_promos/" + id;
  }
  return link;
}

function getTextId(locationPromo) {
  id = "";
  if(locationPromo == 1) {
    id = "#service_text";
  }
  else if (locationPromo == 0) {
    id = "#order_text";
  }
  return id;
}

function getErrorId(locationPromo) {
  id = "";
  if(locationPromo == 1) {
    id = "#error_service";
  }
  else if (locationPromo == 0) {
    id = "#error_order";
  }
  return id;
}
