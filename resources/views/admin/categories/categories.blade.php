@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Categories </div>
                    <div class="card-body">

                            <form method="post" action="{{ 'categories' }}" class="row">
                                    @csrf

                                        <div class="form-group col-md-6">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required >
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">Save New Category</button>
                                        </div>

                                </form>

                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-3">

                                    <div class="alert alert-primary" role="alert">

                                            <span class="btn-spans">
                                                    {{-- data attribute from php to js --}}
                                                    <span><a class="edit-category"
                                                        data-categoryeditname = "{{ $category->name}}"
                                                        data-categoryeditid="{{ $category->id }}"><i class="fas fa-edit"></i></a></span>

                                                    <span><a class="delete-category"
                                                        data-categoryname = "{{ $category->name }}"
                                                        data-categoryid="{{ $category->id }}" ><i class="fas fa-trash-alt"></i></a></span>
                                                </span>

                                        <p>{{ $category->name }}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        {{-- {{ $categories->links() }} --}}

                        {{ (!is_null($showLinks) && $showLinks) ? $categories->links() : '' }}

                            {{-- Search Category --}}

                    <form method="get" action="{{ route('search-categories') }}" >
                            @csrf
                            <div class="row">

                                    <div class="form-group col-md-6">
                                        <input id="category_search" class="form-control" type="text" name="category_search" placeholder="Search Category" required >

                                    </div>
                                    <div class="form-group col-md-6" >
                                        <button type="submit" class="btn btn-primary "><i class="fas fa-search"></i> </button>
                                    </div>
                            </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


        {{-- edit modal --}}

        <div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form method="post" action="{{ 'categories' }}">
                                    @csrf

                                        <div class="form-group col-md-6">
                                            <label for="edit_category_name_again">Category Name</label>
                                            <input type="text" class="form-control" id="edit_category_name_again" name="category_name" placeholder="Category Name" required >
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                                <label for="edit_unit_code">Unit Code</label>
                                                <input type="text" class="form-control" id="edit_unit_code" name="unit_code" placeholder="Unit Code" required >
                                        </div> --}}

                                        <input type="hidden" name="_method" value="put"/>
                                        <input type="hidden" name="category_id" value="" id="edit_category_id">

                                        {{-- <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">Save New Unit</button>
                                        </div> --}}


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                      <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>

            {{-- delete  modal --}}

            <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Delete Category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        {{-- delete form --}}

                        <form action="{{ route('categories') }}" method="post" style="position:relative">
                                @csrf
                            <div class="modal-body">
                                <p id="delete-message"> </p>

                                <input type="hidden" name="_method" value="delete"/>
                                <input type="hidden" name="category_id" value="" id="category_id">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn btn-primary">DELETE</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>



    @if (Session::has('message'))
              {{-- Toast --}}
        <div class="toast" style="position: absolute; top: 10%; right: 10%;">
            <div class="toast-header">
                <strong class="mr-auto">Unit</strong>
                {{-- <small>11 mins ago</small> --}}
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">

                    {{ Session::get('message') }}

            </div>
        </div>
@endif

@endsection


@section('script')

    <script>

var $deleteCategory = $('.delete-category');
            var $deleteWindow = $('#delete-window');
            var $categoryID = $('#category_id');
            var $deleteMessage = $('#delete-message');

            $deleteCategory.on('click', function(element){
                //stop behavior default
                element.preventDefault();
                // gevin data from data Attribute
                var $category_id = $(this).data('categoryid');
                $categoryID.val($category_id);
                $deleteMessage.text('Are you sure you want to delete this category ? ');
                $deleteWindow.modal('show');
            });

            var $editCategory = $('.edit-category');
            var $editWindow = $('#edit-window');
            var $nameEditCategoryAgain = $('#edit_category_name_again');
            var $categoryEditID = $('#edit_category_id');


            $editCategory.on('click', function(element){

                element.preventDefault();

                var $categoryIDEdit = $(this).data('categoryeditid');
                var $categoryNameEdit = $(this).data('categoryeditname');

                $categoryEditID.val($categoryIDEdit);
                $nameEditCategoryAgain.val($categoryNameEdit);
                $editWindow.modal('show');
            });

    </script>
     @if (Session::has('message'))
                <script>
                    jQuery(document).ready(function($){
                        var $toast = $('.toast').toast({
                            autohide :false
                        });

                        $toast.toast('show');
                    })
                </script>
    @endif


@endsection
