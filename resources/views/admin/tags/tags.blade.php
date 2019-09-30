@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Tags </div>
                <div class="card-body">

                        <form method="post" action="{{ route('tags') }}" class="row">
                                @csrf

                                    <div class="form-group col-md-12">
                                        <label for="tag_name">Tag Name</label>
                                        <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Tag Name" required >
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Save New Tag</button>
                                    </div>

                            </form>

                    <div class="row">
                        @foreach ($tags as $tag)
                        <div class="col-md-3">
                            <div class="alert alert-primary" role="alert">

                                    <span class="btn-spans">
                                            {{-- data attribute from php to js --}}
                                            <span><a class="edit-tag"
                                                data-tageditname = "{{ $tag->tag}}"
                                                data-tageditid="{{ $tag->id }}"><i class="fas fa-edit"></i></a></span>

                                            <span><a class="delete-tag"
                                                data-tagname = "{{ $tag->tag }}"
                                                data-tagid="{{ $tag->id }}" ><i class="fas fa-trash-alt"></i></a></span>
                                        </span>

                                {{ $tag->tag }}
                            </div>
                        </div>

                        @endforeach
                    </div>
                    {{-- {{ $tags->links() }} --}}
                    {{ (! is_null($showLinks) && $showLinks) ? $tags->links() : '' }}

                    {{-- Search Tag --}}

                    <form method="post" action="{{ route('search-tags') }}" >
                            @csrf
                            <div class="row">

                                    <div class="form-group col-md-6">
                                        <input id="tag_search" class="form-control" type="text" name="tag_search" placeholder="Search Tag" required >

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
                  <h5 class="modal-title">Edit Tag</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                        <form method="post" action="{{ 'tags' }}">
                                @csrf

                                    <div class="form-group col-md-6">
                                        <label for="edit_tag_name_again">Tag Name</label>
                                        <input type="text" class="form-control" id="edit_tag_name_again" name="tag_name" placeholder="Tag Name" required >
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                            <label for="edit_unit_code">Unit Code</label>
                                            <input type="text" class="form-control" id="edit_unit_code" name="unit_code" placeholder="Unit Code" required >
                                    </div> --}}

                                    <input type="hidden" name="_method" value="put"/>
                                    <input type="hidden" name="tag_id" value="" id="edit_tag_id">

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
                      <h5 class="modal-title">Delete Tag</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    {{-- delete form --}}

                    <form action="{{ route('tags') }}" method="post" style="position:relative">
                            @csrf
                        <div class="modal-body">
                            <p id="delete-message"> </p>

                            <input type="hidden" name="_method" value="delete"/>
                            <input type="hidden" name="tag_id" value="" id="tag_id">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary">DELETE</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

 {{-- Toast Message --}}
@if (Session::has('message'))
              {{-- Toast --}}
        <div class="toast" style="position: absolute; top: 10%; right: 10%;">
            <div class="toast-header">
                <strong class="mr-auto">Tag</strong>
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
            var $deleteTag = $('.delete-tag');
            var $deleteWindow = $('#delete-window');
            var $tagID = $('#tag_id');
            var $deleteMessage = $('#delete-message');

            $deleteTag.on('click', function(element){
                //stop behavior default
                element.preventDefault();
                // gevin data from data Attribute
                var $tag_id = $(this).data('tagid');
                $tagID.val($tag_id);
                $deleteMessage.text('Are you sure you want to delete this tag ? ');
                $deleteWindow.modal('show');
            });

            var $editTag = $('.edit-tag');
            var $editWindow = $('#edit-window');
            var $nameEditTagAgain = $('#edit_tag_name_again');
            var $tagEditID = $('#edit_tag_id');


            $editTag.on('click', function(element){

                element.preventDefault();

                var $tagIDEdit = $(this).data('tageditid');
                var $tagNameEdit = $(this).data('tageditname');

                $tagEditID.val($tagIDEdit);
                $nameEditTagAgain.val($tagNameEdit);
                $editWindow.modal('show');
            });
        </script>

@if (Session::has('message'))

    <script>
        $(document).ready(function(){
            var $toast = $('.toast').toast({
                autohide : false ,
            });

            $toast.toast('show');
        });
    </script>

@endif

@endsection
