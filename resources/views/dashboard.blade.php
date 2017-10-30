@extends('layouts.garage')

@section('panel')
<script src="{{ asset('js/categories.js') }}"></script>
@include('modals.category_modal')
@include('modals.edit_category_modal')
@include('modals.confirmation_modal', ['text' => 'category',
                                       'function' => 'deleteCategory()'])
   <div class="panel panel-default">
     <div class="panel-heading">
       <h3 style="font-weight: bold;" class="panel-title pull-left">
         Product Categories: </h3>
        <span onclick="showCategoryModal()" class="pull-right" title="Add New Category">
          <i class="fa fa-plus-circle fa-2x text-primary" style="cursor: pointer;"></i></span>
        <div class="clearfix"></div>
     </div>
     <div class="panel-body">
       <div class="table-responsive">
         <table id="myTable" class="table table-striped">
             <thead>
               <tr>
                 <th>No.</th>
                 <th>Name</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               @foreach($categories as $category)
                       <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $category->name }}</td>
                         <td>
                           <div class="btn-group">
                             <button type="button" class="btn btn-primary"
                              onclick="showEditModal({{ $category }})"
                              title="Edit Category">
                               <span class="glyphicon glyphicon-pencil"></span>
                             </button>
                             <button type="button" class="btn btn-danger"
                              onclick="showConfirmation({{ $category->id }})"
                              title="Delete Category">
                               <span class="glyphicon glyphicon-trash"></span>
                             </button>
                           </div>
                         </td>
                       </tr>
              @endforeach
            </tbody>
          </table>
        </div>
     </div>
     <div class="panel-footer">
       Crafted @ <a href="http://ipfsoftwares.com" target="_blank">iPF SOFTWARES</a>
     </div>
     <script>
         myDataTable("Product Categories", "Product Category List As Per {{now()->format('d-m-Y')}}");
     </script>
   </div>
@endsection
