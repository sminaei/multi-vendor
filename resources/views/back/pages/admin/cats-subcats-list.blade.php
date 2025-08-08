@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    @livewire('admin-categories-subcategories-list')
@endsection
@push('scripts')
    <script>
        $('table tbody#sortable_categories').sortable({
            cursor: "move",
            update: function (event,ui){
                $(this).children().each(function (index){
                    if($(this).attr("data-ordering") != (index+1)){
                        $(this).attr("data-ordering",(index+1)).addClass("updated")
                    }
                });
                var positions = [];
                $(".updated").each(function (){
                    positions.push([$(this).attr("data-index"),$(this).attr("data-ordering")]);
                    $(this).removeClass("updated");
                });
                // alert(positions);
                window.livewire.emit("updateCategoryOrdering",positions);
            }
        });
        $(document).on('click','.deleteCategoryBtn',function (e){
            e.preventDefault();
            var category_id = $(this).data('id');
            swal.fire({
                title: 'are you sure?',
                html: 'you want to delete category',
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'yes,delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#30856d',
                width: 300,
                allowOutsideClick:false
            }).then(function (result){
                if(result.value){
                    window.livewire.emit('deleteCategory',category_id)
                   window.livewire.emit('deleteCategory',category_id)
                }
            });
        })
    </script>
@endpush
