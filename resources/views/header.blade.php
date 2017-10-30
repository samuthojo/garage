<!doctype html>
<html>
<head>

  <title>Mechmaster</title>

  <!-- Csrf token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- DataTable Css-->
  <link rel="stylesheet" type="text/css"
    href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet"
  	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="{{ asset('css/app.css')}}"> -->

  <!--Pulling Awesome Font -->
  <link
    href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
    rel="stylesheet">

  <!-- DataTable Css For Copy, Csv, Excel, Pdf, Print buttons-->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">

  <!-- jQuery library -->
  <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>

  <!-- Latest compiled JavaScript -->
  <script
  	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>
  <!-- <script src="{{ asset('js/app.js') }}"></script> -->

  <!-- DataTable -->
  <script type="text/javascript" charset="utf8"
    src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>

  <!-- DataTable Copy, Csv, Excel, Pdf, Print functionality-->
  <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

  <!-- DataTable Date Sorting functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js">
  </script>

  <!-- DataTable Date Sorting functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js">
  </script>

  <script src="{{ asset('js/main.js') }}"></script>

  <style>
    /*.modal-dialog{
        overflow-y: initial !important
    }
    .modal-body{
      max-height: calc(100vh - 200px);
      overflow-y: auto;
    }*/
    .form-control {
      width: 200px;
    }
  </style>
