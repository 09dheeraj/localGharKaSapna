@extends('layouts.inner_page')
@section('content')
<style>
    .form-container {
        border-radius: 15px;
        padding: 20px;
        background: #f8f9fa;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group h6 {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
    }

    /* 
    .btn-thm {
        background-color: #007bff;
        color: white;
    }

    .btn-thm:hover {
        background-color: #0056b3;
    }

    .custom-add-btn {
        border-radius: 10px;
    } */

    .tag-del {
        cursor: pointer;
        color: red;
    }

    img#additionalImagesPreview {
        height: 156px;
        width: 399px;
        margin-left: 100px;
        margin-top: 18px;
    }

    img#featuredImagePreview {
        height: 156px;
        width: 399px;
        margin-left: 100px;
        margin-top: 18px;
    }

    img.edit-featured-image {
        height: 156px;
        width: 399px;
    }
</style>
<div class="container mt-5">
    <h2>Update Your News & Articles</h2>
    <p class="text">We're excited to have you back! Share your latest stories and updates with us.</p>

    @if(session('success'))

    <div class="col-lg-6 success-mesg">
        <div class="ui-content">
            <div class="message-alart-style1">
                <div class="alert alart_style_four alert-dismissible fade show mb20" role="alert">Success: {{ session('success') }}
                    <i class="far fa-xmark btn-close" data-bs-dismiss="alert" aria-label="Close"></i>
                </div>
            </div>
        </div>
    </div>
    @endif
    <form action="{{route('update.articles')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card form-container">
            <div class="card-body">

                <div class="form-group row align-items-center pt-4 pb-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Title</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="title" placeholder="Title Name">{{$article->title}}</textarea>

                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Meta Title</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="meta_title" placeholder="Meta Title">{{$article->meta_title}}</textarea>
                        <input type="hidden" name="article_id" value="{{$article->id}}">
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Meta Description</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="meta_description" placeholder="Meta Description">{{$article->meta_description}}</textarea>
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Meta Keywords</h6>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="meta_keywords" class="form-control form-control-lg" placeholder="Meta Keywords" value="{{$article->meta_keywords}}">
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Tick Title</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="tick_title" placeholder="Tick title">{{$article->heading}}</textarea>
                    </div>
                </div>



                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Excerpt</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control form-control-lg" rows="3" name="excerpt" placeholder="Short summary or tick description">{{$article->excerpt}}</textarea>
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Short Description</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control form-control-lg" rows="3" name="short_description" placeholder="Short description of the article">{{$article->short_description}}</textarea>
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Content</h6>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control form-control-lg" rows="5" name="content" placeholder="Full content of the article">{{$article->content}}</textarea>
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Featured Image</h6>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control form-control-lg" id="feature-img" name="featured_image" type="file">
                        <img id="featuredImagePreview" class="d-none mt10">
                        <a href="#" id="deleteFeaturedImage" class="tag-del " style="display: none;" data-bs-toggle="tooltip" title="Delete Image"><span class="fas fa-trash-can"></span></a>
                    </div>
                    @if(!empty($article->featured_image))
                    <img class="mt10 edit-featured-image" src="{{asset('assets/articlesImages/'. $article->featured_image) }}">
                    @endif
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-3">
                        <h6 class="mb-0">Additional Images</h6>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control form-control-lg" name="additional_images[]" multiple accept="image/*" type="file" id="additional-img">
                        <img id="additionalImagesPreview" class="mr10 d-none">
                        <a href="#" id="deleteAdditionalImages" class="tag-del" data-bs-toggle="tooltip" style="display: none;" title="Delete Image"><span class="fas fa-trash-can"></span></a>
                    </div>
                </div>
                <?php $images = explode(',', $article->additional_images); ?>
                @if(!empty($article->additional_images))
                @foreach($images as $img)
                <img class="mt10" src="{{asset('assets/articlesImages/'. $img) }}">
                @endforeach
                @endif

                <div class="row align-items-center py-3">
                    <div class="col-md-3 ps-5">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="col-md-6 pe-3">
                        <select name="categories" id="categories" class="form-control w-100" required>
                            <option selected disabled>Please select a category</option>
                            @foreach($articleCat as $cat)
                            <option value="{{$cat->id}}" {{$article->category == $cat->id ? 'selected' : ''}}>{{ucwords($cat->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 pe-5">
                        <a class="ud-btn btn-dark btn-block custom-add-btn w-100" data-bs-toggle="modal" data-bs-target="#categoryModel">Add Category</a>
                    </div>
                </div>

                <div class="form-group row align-items-center py-3">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="ud-btn btn-thm">Update Article</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="categoryModel" tabindex="-1" aria-labelledby="categoryModelLabel" aria-hidden="true">
    <div class="modal-dialog centered">
        <div class="modal-content">
            <div class="modal-body">

                <label class="text-color-black fw600 mb10">Add Category</label>
            </div>

            <div class="modal-body">
                <label for="category-name"><b>Category</b></label>
                <input type="text" id="article-cat" placeholder="Enter category name" class="form-control"><br>
                <span id="cat-error" class="text-danger"></span>
            </div>

            <div class="modal-footer">
                <button class="ud-btn btn-dark btn-block custom-add-btn w-100" id="add-category">Add</button>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        function handleImage(input, previewId, deleteBtnId) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(previewId).attr('src', e.target.result).removeClass('d-none');
                $(deleteBtnId).show();
            }

            reader.readAsDataURL(input.files[0]);
        }

        $('#feature-img').change(function() {
            handleImage(this, '#featuredImagePreview', '#deleteFeaturedImage');
        });

        $('#deleteFeaturedImage').click(function(e) {
            e.preventDefault();
            $('#feature-img').val('');
            $('#featuredImagePreview').addClass('d-none').attr('src', '');
            $(this).hide();
        });

        $('#additional-img').change(function() {
            handleImage(this, '#additionalImagesPreview', '#deleteAdditionalImages');
        });

        $('#deleteAdditionalImages').click(function(e) {
            e.preventDefault();
            $('#additional-img').val('');
            $('#additionalImagesPreview').addClass('d-none').attr('src', '');
            $(this).hide();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#add-category').click(function() {

            var category = $('#article-cat').val();

            if (!category.trim()) {
                $('#cat-error').text('Please enter a category name.');
                return;
            }

            $.ajax({
                'url': "{{route('add.article.category')}}",
                type: "POST",
                data: {
                    cat: category,
                    "_token": "{{csrf_token()}}",
                },
                success: function(response) {
                    console.log(response);
                    if (response.exist) {
                        $('#cat-error').text('Category already exists!');
                        return;
                    } else if (response.success) {

                        $('#categories').append($('<option>', {
                            value: response.category.id,
                            text: response.category.name
                        }));
                        $('#categoryModel').hide();

                        $('#article-cat').val('');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Category added successfully!',
                            timer: 3000,
                            showConfirmButton: false
                        });

                    } else {
                        $('#cat-error').text(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    });
</script>


@endsection