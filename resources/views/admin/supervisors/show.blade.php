@extends('admin.layouts.master')
@section('css')
@endsection


@section('title')
    Admin Detail
@endsection

@section('breadcamb')
    Admin Detail ({{ ucwords($adminDetail->name) }})
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-lg-6 col-sm-12">
            <div class=" mg-b-20">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">{{ ucwords($adminDetail->type) }} Detail</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                            <p class="tx-12 tx-gray-500 mb-2">Personal Detail</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="w-25">Full Name</th>
                                            <td>{{ $adminDetail->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Mobile</th>
                                            <td>{{ $adminDetail->mobile }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">E-mail</th>
                                            <td>{{ $adminDetail->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Status</th>
                                            <td>
                                                <div class="spinner-grow spinner-grow-sm {{ $adminDetail->status == '1' ? 'green' : 'red' }}"
                                                    role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <span
                                                    class="text text-{{ $adminDetail->status == '1' ? 'success' : 'danger' }}">
                                                    {{ $adminDetail->status == '1' ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Bio</th>
                                            <td>{{ $adminDetail->about_me }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!is_null($adminDetail->vendor_id))
            @php
                $vendor = $adminDetail->vendor;
            @endphp
            <div class="col-lg-6 col-sm-12">
                <div class=" mg-b-20">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{ ucwords($adminDetail->type) }} Detail</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                                <p class="tx-12 tx-gray-500 mb-2">More Personal Detail</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mg-b-0 text-md-nowrap table-striped">
                                        <tbody>
                                            <tr>
                                                <th class="w-25">Address</th>
                                                <td>{{ $vendor->address }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">city</th>
                                                <td>{{ $vendor->city }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">state</th>
                                                <td>{{ $vendor->state }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">country</th>
                                                <td>{{ $vendor->country }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">pincode</th>
                                                <td>{{ $vendor->pincode }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class=" mg-b-20">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{ ucwords($adminDetail->type) }} Detail</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                                <p class="tx-12 tx-gray-500 mb-2">Business Detail</p>
                            </div>
                            <div class="card-body">
                                @if ($vendor->businessInfo->getFirstMediaUrl('vendor_address_proof_images'))
                                    <img src="{{ $vendor->getFirstMediaUrl('vendor_address_proof_images') }}"
                                        alt="">
                                    <hr>
                                @endif
                                <div class="table-responsive">
                                    <table class="table mg-b-0 text-md-nowrap table-striped">
                                        <tbody>
                                            <tr>
                                                <th class="w-50">Shop name</th>
                                                <td>{{ $vendor->businessInfo->shop_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop address</th>
                                                <td>{{ $vendor->businessInfo->shop_address }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop city</th>
                                                <td>{{ $vendor->businessInfo->shop_city }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop state</th>
                                                <td>{{ $vendor->businessInfo->shop_state }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop country</th>
                                                <td>{{ $vendor->businessInfo->shop_country }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop pincode</th>
                                                <td>{{ $vendor->businessInfo->shop_pincode }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop mobile</th>
                                                <td>{{ $vendor->businessInfo->shop_mobile }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop website</th>
                                                <td>{{ $vendor->businessInfo->shop_website }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Shop email</th>
                                                <td>{{ $vendor->businessInfo->shop_email }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Address proof</th>
                                                <td>{{ strtoupper(App\Models\Vendor::ADDRESSPROOF[$vendor->businessInfo->address_proof]) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">Business license number</th>
                                                <td>{{ $vendor->businessInfo->business_license_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">GST number</th>
                                                <td>{{ $vendor->businessInfo->gst_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-50">PAN number</th>
                                                <td>{{ $vendor->businessInfo->pan_number }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class=" mg-b-20">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{ ucwords($adminDetail->type) }} Detail</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                                <p class="tx-12 tx-gray-500 mb-2">Bank Detail</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mg-b-0 text-md-nowrap table-striped">
                                        <tbody>
                                            <tr>
                                                <th class="w-25">Account holder name</th>
                                                <td>{{ $vendor->account_holder_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Bank name</th>
                                                <td>{{ $vendor->bank_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Account number</th>
                                                <td>{{ $vendor->account_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Bank IFSC code</th>
                                                <td>{{ $vendor->bank_ifsc_code }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('js')
@endsection
