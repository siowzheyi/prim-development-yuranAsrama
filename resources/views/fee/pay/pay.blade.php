<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-light" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/app.min.css') }}" id="app-light" rel="stylesheet" type="text/css" />
    <style>
        span {
            font-size: 1.09375rem;
            font-weight: bolder;
        }
    </style>
    <title>PRiM | Pembayaran</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/logo/fav-logo-prim.png')}}">

</head>

<body>
    <div class="container">
        <div class="card rounded-xl mt-4">
            <div class="card-body shadow rounded mb-1" style="background-color:#323447">
                <center>
                    <img src="{{ URL::asset('assets/images/logo/prim.svg') }}" alt="" height="50">
                </center>
            </div>
            @php
            $i =0 ;
            @endphp
            <div class="card-text p-4">


                <h4 class=" mb-3" style="text-align: center">
                    {{ $getfees_category_A ? $getorganization->nama :  ""}}</h4>

                @if ($getfees_category_A)

                @foreach($getfees_category_A as $row2)
                <hr>
                <h4 class=" mb-3 mt-3">--{{ $row2->category }}--</h4>

                <div class="row">


                    @foreach($getfees_category_A_byparent as $row3)
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <h4>{{ $loop->iteration }}. {{ $row3->name }}</h4>
                            </div>
                            <div class="col-12">
                                <h5 class="mt-0" style="color:#8699ad">
                                    Kuantiti x{{ $row3->quantity }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        @php
                        $i += $row3->quantity*$row3->price ;
                        @endphp
                        <h4 class="float-right">$ {{ number_format($row3->quantity*$row3->price, 2) }} </h4>
                    </div>
                    @endforeach
                </div>
                @endforeach

                @foreach ($get_fees_by_parent as $get_fees_by_parents)

                    <input type="hidden" name="parent_fees_id[]" value="{{ $get_fees_by_parents->id }}">

                @endforeach

                @endif


                @if ($getstudent)

                <hr>

                @foreach($getstudent as $row)
                <h4 class=" mb-3" style="text-align: center">{{$row->studentname}}</h4>

                <hr>
                @foreach($getfees->where('studentid', $row->studentid) as $row2)

                <h4 class=" mb-3 mt-3">--{{ $row2->category }}--</h4>

                <div class="row">

                    @foreach($getfees_bystudent->where('studentid', $row->studentid)->where('category', $row2->category)
                    as $row3)
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <h4>{{ $loop->iteration }}. {{ $row3->name }}</h4>
                            </div>
                            <div class="col-12">
                                <h5 class="mt-0" style="color:#8699ad">
                                    Kuantiti x{{ $row3->quantity }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        @php
                        $i += $row3->quantity*$row3->price ;
                        @endphp
                        <h4 class="float-right">$ {{ number_format($row3->quantity*$row3->price, 2) }} </h4>
                    </div>
                    @endforeach

                </div>
                @endforeach
                <hr>
                @endforeach

                @foreach ($getstudentfees as $studentfees)

                <input type="hidden" name="student_fees_id[]" value="{{ $studentfees->id }}">

                @endforeach

                @endif

                <div class="row mb-4">
                    <div class="col-6">
                        <h5 class=" mb-3">Caj yang dikenakan </h5>
                    </div>
                    <div class="col-6">
                        <h5 class="float-right mb-3">$<span id="amount">
                                {{ number_format($getorganization->fixed_charges, 2) }}</span> </h5>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <h4 class=" mb-3">Jumlah Bayaran</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="float-right mb-3">$<span id="amount" style="font-size: 22px;">
                                {{ number_format($i + $getorganization->fixed_charges, 2) }}</span> </h4>
                    </div>
                </div>

                <form method="POST" action="{{ route('toyyib.payment') }}" enctype="multipart/form-data">
                <!-- <div class="form-group">
                    <label for="sel1">Sila Pilih Bank:</label>
                    <select name="bankid" id="bankid" class="form-control" data-parsley-required-message="Sila pilih bank" required>
                        <option value="">Pilih bank</option>
                    </select>
                </div> -->

                <!-- <div class="form-group">
                    <label for="sel1">Sila Pilih Bank:</label>
                    <select name="bankid" id="bankid" class="form-control" data-parsley-required-message="Sila pilih bank" required>
                        <option value="">Pilih bank</option>
                        <option value="ABB0233">Affin Bank</option>
                        <option value='ABMB0212'>Alliance Bank (Personal)</option>
                        <option value='AGRO01'>AGRONet</option>
                        <option value='AMBB0209'>AmBank</option>
                        <option value='BIMB0340'>Bank Islam</option>
                        <option value='BMMB0341'>Bank Muamalat</option>
                        <option value='BKRM0602'>Bank Rakyat</option>
                        <option value='BSN0601'>BSN</option>
                        <option value='BCBB0235'>CIMB Clicks</option>
                        <option value='HLB0224'>Hong Leong Bank</option>
                        <option value='HSBC0223'>HSBC Bank</option>
                        <option value='KFH0346'>KFH</option>
                        <option value='MBB0228'>Maybank2E</option>
                        <option value='MB2U0227'>Maybank2U</option>
                        <option value='OCBC0229'>OCBC Bank</option>
                        <option value='PBB0233'>Public Bank</option>
                        <option value='RHB0218'>RHB Bank</option>
                        <option value='SCB0216'>Standard Chartered</option>
                        <option value='UOB0226'>UOB Bank</option>
                        <option value='BOCM01'>Bank Of China</option>

                    </select>
                </div> -->

                @if ($getfees_category_A)
                @foreach ($get_fees_by_parent as $get_fees_by_parents)

                <input type="hidden" name="parent_fees_id[]" value="{{ $get_fees_by_parents->id }}">

                @endforeach
                @endif

                @if ($getstudent)
                @foreach ($getstudentfees as $studentfees)

                <input type="hidden" name="student_fees_id[]" value="{{ $studentfees->id }}">

                @endforeach
                @endif


                <!-- <ul>
                    <li>
                        <p>Minimum Transaction is $1 and Maximum Transaction is $30,000.</p>
                    </li>
                </ul> -->
                {{ csrf_field() }}
                <input type="hidden" name="amount" id="amount" value={{ $i + $getorganization->fixed_charges }}>
                <input type="hidden" name="o_id" id="o_id" value="{{ $getorganization->id }}">
                <input type="hidden" name="desc" id="desc" value="School_Fees">
                <!-- <div class="float-right">
                    <input type="checkbox" id="TC" name="TC" onchange="
                        if (this.checked)
                            document.getElementById('bayarBtn').disabled = false;
                        else
                            document.getElementById('bayarBtn').disabled = true;
                        "><label style="margin-left: 5px" for="TC"><a
                            href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">I Agree to
                            the FPX Terms And Condition.</a></label>
                </div> -->
                <button id="bayarBtn" class="btn btn-primary float-right mt-3 w-100 p-2" style="font-size:18px"
                    type="submit">Teruskan Pembayaran Di PayPal</button>
                    <!-- onclick="return checkBank();" -->
                </form>
                <a href="{{ route('error') }}">
                    <button type="button" class="btn btn-danger float-right mt-3 w-100 p-2" style="font-size:18px">Batalkan</button>
                </a>
            </div>

        </div>

    </div>
</body>

</html>

<script>
    function checkBank() {
        var t = jQuery('#bankid').val();
        var a = parseFloat(jQuery('#amount').val());
        if (t === '' || t === null) {
            alert('Please select a bank');
            return false;
        }
        if (a < 1.00) {
            alert('Transaction Amount is Lower than the Minimum Limit $1.00 for B2C');
            return false;
        }
        else if (a > 30000.00) {
            alert('Transaction Amount Limit Exceeded $30,000.00 for B2C');
            return false;
        }
    }

    var arr = [];

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: "getBankFPX", //"/fpx/getBankList",
        success: function(data) {
            jQuery.each(data.data, function(key, value){
                arr.push(key);
            });
            for(var i = 0; i < arr.length; i++){
                arr.sort();
                $("#bankid").append("<option value='"+data.data[arr[i]].code+"'>"+data.data[arr[i]].nama+"</option>");
            }

        },
        error: function (data) {
            // console.log(data);
        }
    });
</script>