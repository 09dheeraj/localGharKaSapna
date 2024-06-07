@extends('layouts.inner_page')
@section('content')

<?php

function formatPrice($price)
{
    if (!is_numeric($price)) {
        return 'N/A';
    }

    if ($price >= 10000000) {
        return '₹' . number_format($price / 10000000, 2) . ' Cr';
    } elseif ($price >= 100000) {
        return '₹' . number_format($price / 100000, 2) . ' Lac';
    } else {
        return '₹' . number_format($price / 1000, 2) . ' K';
    }
}



?>
<style>
    .under-review {
        font-weight: 800;
        padding-top: 10px;
        color: #f1416c;
    }
</style>

<div class="row align-items-center pb40">
    <div class="col-xxl-3">
        <div class="dashboard_title_area">
            <h2>My Properties</h2>
            <p class="text">We are glad to see you again!</p>
        </div>
    </div>
    <div class="col-xxl-9">
        <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
            <div class="item1 mb15-sm">
                <div class="search_area">
                    <input type="text" class="form-control bdrs12" id="searchInput" placeholder="Search">
                    <label><span class="flaticon-search"></span></label>
                </div>
            </div>

            <a target="_blank" href="{{route('post.property')}}" class="ud-btn btn-thm">Add New Property<i class="fal fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
            <div class="packages_table table-responsive">
                <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                        <tr>
                            <th scope="col">Listing title</th>
                            <th scope="col">Date Published</th>
                            <th scope="col">Property</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="t-body" id="propertyTableBody">
                        @foreach($properties as $property)
                        <tr>
                            <th scope="row">
                                <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
                                    @if(!empty($property->images))
                                    <div class="list-thumb">
                                        @php $images = explode(',', $property->images) @endphp
                                        @foreach($images as $img)
                                        <img class="w-100" src="{{asset('assets/postImages/'. $img) }}" alt="">
                                        @break
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="list-content py-0 p-0 mt-2 mt-xxl-0 ps-xxl-4">
                                        <div class="h6 list-title"><a href="page-property-single-v1.html">{{substr($property->property_name, 0, strrpos($property->property_name, ' '))}}</a></div>
                                        <p class="list-text mb-0">{{ ucwords($property['project_society']) }}, {{ ucwords($property['locality']) }}, {{ ucwords($property['city']) }}</p>
                                        <div class="list-price">{{formatPrice($property->price)}} {!! $property->looking_to == 'sell' ? '' : '/<span>mo</span>' !!}</div>

                                        @if($property->status == 'processing')
                                        <div class="">
                                            <div class="under-review"><a>These Property is Under Review</a></div>
                                        </div>
                                        @endif


                                    </div>
                                </div>
                            </th>
                            <?php
                            $dateString = $property->created_at;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('M d, Y');

                            $statusCounts = [
                                'pending' => '1',
                                'published' => '2',
                                'processing' => '3'
                            ];
                            $count = $statusCounts[$property->status] ?? '';

                            ?>

                            <td class="vam">{{$formattedDate}}</td>
                            <td class="vam">{{ $property->looking_to == 'pg' ? 'PG/Co-Living' : ucfirst($property->categories)}}</td>
                            <td class="vam"><span class="pending-style style{{$count}}">{{$property->status}}</span></td>
                            <td class="vam">
                                <div class="d-flex">
                                    <a href="" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                                    <a class="icon delete-property" data-id="{{$property->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                                    <a class="icon" data-bs-toggle="modal" data-bs-toggle="top" title="Change status" data-bs-target="#statusModal{{$property->id}}" data-id="{{$property->id}}" data-status="{{$property->status}}"><span class="fas fa-pen fa"></span></a>


                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="statusModal{{$property->id}}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                            <div class="modal-dialog centered">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <label class="text-color-black fw600 mb10">Mange Status</label>
                                        <div class="location-area">
                                            <select id="statusSelect" class="selectpicker" name="mange_status" required>
                                                <option selected disabled>Select an option</option>
                                                <option value="pending" {{ $property->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="published" {{ $property->status == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="processing" {{ $property->status == 'processing' ? 'selected' : '' }}>Processing</option>>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="ud-btn btn-dark btn-block custom-add-btn w-100" id="submitstatus" data-id="{{$property->id}}">submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </tbody>
                </table>

                <style>
                    #loadMoreTrigger {
                        height: 1px;
                    }
                </style>

                <div id="loadMoreTrigger"></div>


            </div>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, rows, title, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('propertyTableBody');
        rows = table.getElementsByTagName('tr');

        for (i = 0; i < rows.length; i++) {
            title = rows[i].getElementsByTagName('th')[0].textContent || rows[i].getElementsByTagName('th')[0].innerText;
            if (title.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        let rows = document.querySelectorAll('#propertyTableBody tr');
        let visibleRowCount = 20;


        for (let i = visibleRowCount; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }


        function showMoreRows() {
            const nextRowCount = visibleRowCount + 15;
            for (let i = visibleRowCount; i < nextRowCount && i < rows.length; i++) {
                rows[i].style.display = '';
            }
            visibleRowCount = nextRowCount;
        }


        const loadMoreTrigger = document.getElementById('loadMoreTrigger');
        const observer = new IntersectionObserver(entries => {
            if(entries[0].isIntersecting) {
                showMoreRows();
            }
        });

        observer.observe(loadMoreTrigger);

    });
</script>

<script>
    $(document).on('click', '#submitstatus', function(e) {
        e.preventDefault();

        const propertyId = $(this).data('id');
        const selectedValue = $(this).closest('.modal').find('#statusSelect').val();
        var modal = $(this).closest('.modal');
        modal.modal('hide');
        $.ajax({
            url: "{{ route('manage.property.status') }}",
            method: 'POST',
            data: {
                propertyId: propertyId,
                selectedValue: selectedValue,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var status = response.status;
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Status changed successfully!',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(function() {

                        location.reload();
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 3000);

                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    $(document).on('click', '.delete-property', function() {
        var row = $(this).closest('tr');
        var propertyID = $(this).data('id');
        Swal.fire({
            title: 'Confirm Deletion',
            text: "Are you sure you want to delete this property ? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('property.delete.admin')}}",
                    type: "POST",
                    data: {
                        propertyID: propertyID,
                        "_token": "{{csrf_token()}}"
                    },

                    success: function(response) {

                        //console.log(response);
                        if (response.success) {

                            row.remove();
                            Swal.fire(
                                'Deleted!',
                                'Your property has been deleted.',
                                'success'
                            );

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                    }
                });
            }
        })
    });
</script>





@endsection