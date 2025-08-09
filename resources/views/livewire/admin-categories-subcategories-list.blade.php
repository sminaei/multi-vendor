<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4>Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href=" {{ route('admin.manage-categories.add-category') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"> </i>
                            Add Category</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                        <tr>
                            <th>Category image</th>
                            <th>Category name</th>
                            <th>N Sub Category name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="sortable_categories">
                        @forelse($categories as $item)
                            <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                                <td>
                                    <div class="avatar mr-2">
                                        <img src="/images/categories/{{ $item->category_image }}" width="50" height="50">
                                    </div>
                                </td>
                                <td>
                                    {{ $item->category_name }}
                                </td>
                                <td>
                                    {{ $item->subcategories->count() }}
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.manage-categories.edit-category',[ 'id'=> $item->id ]) }}" class="text-primary">
                                            <i class="dw dw-edit2"></i>
                                        </a>
                                        <a href="javascript:;" class="text-danger deleteCategoryBtn" data-id="{{ $item->id }}">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <span class="text-danger">No Category Found</span>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $categories->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4>Sub Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-subcategory') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"> </i>
                            Add Sub Category</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                        <tr>
                            <th>Sub Category image</th>
                            <th>Category name</th>
                            <th>Child sub category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="sortable_subcategories">
                        @forelse($subcategories as $item)
                        <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                            <td>
                               {{ $item->subcategory_name }}
                            </td>
                            <td>
                               {{ $item->parentcategory->category_name }}
                            </td>
                            <td>
                                {{ $item->children->count() }}
                            </td>
                            <td>
                                @if($item->children->count() > 0)
                                    <ul class="list-group" id="sortable_child_subcategories">
                                        @foreach($item->children as $child)
                                            <li class="d-flex justify-content-between align-items-center" data-index="{{ $child->id }}" data-ordering="{{ $child->ordering }}">
                                                {{ $child->$subcategory_name }}
                                                <div>
                                                    <a href="{{ route('admin.manage-categories.edit-subcategory',['id'=> $child->id]) }}" class="text-primary" data-toggle="tooltip" title="edit child sub category">Edit</a>|
                                                    <a href="javascript:;" class="text-danger deleteChildSubCategoryBtn" data-toggle="tooltip" title="delete child sub category">Delete</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    none
                                @endif
                            </td>

                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.manage-categories.edit-subcategory',['id'=> $item->id]) }}" class="text-primary">
                                        <i class="dw dw-edit2"></i>
                                    </a>
                                    <a href="javascript:;" class="text-danger deleteChildSubCategoryBtn" data-id="{{ $item->id }}" data-title="Sub category">
                                        <i class="dw dw-delete-3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="text-danger">No sub category found</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $subcategories->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</div>
