@extends('admin.layouts.master')

@if(!empty($lead))
    @section('title', 'Edit Lead')
@else
    @section('title', 'Create Lead')
@endif

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(!empty($lead))
                @php
                $url = route('admin.lead-create-update', ['id' => $lead->faker_id]);
                @endphp
                <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit lead</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" novalidate >
                            <div class="alert alert-danger d-none"></div>
                            <div class="alert alert-success d-none"></div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom00">Lead status
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="lead_status" class="default-select wide form-control" id="validationCustom00">
                                                <option value="unprocessed" {{$lead->lead_status == "unprocessed" ? "selected": ""}}>Unprocessed</option>
                                                <option value="appointment" {{$lead->lead_status == "appointment" ? "selected": ""}}>Appointment</option>
                                                <option value="not_reached_1" {{$lead->lead_status == "not_reached_1" ? "selected": ""}}>Not reached 1</option>
                                                <option value="not_reached_2" {{$lead->lead_status == "not_reached_2" ? "selected": ""}}>Not reached 2</option>
                                                <option value="not_reached_3" {{$lead->lead_status == "not_reached_3" ? "selected": ""}}>Not reached 3</option>
                                                <option value="not_reached_4" {{$lead->lead_status == "not_reached_4" ? "selected": ""}}>Not reached 4</option>
                                                <option value="not_reached_5" {{$lead->lead_status == "not_reached_5" ? "selected": ""}}>Not reached 5</option>
                                                <option value="deadline" {{$lead->lead_status == "deadline" ? "selected": ""}}>Deadline</option>
                                                <option value="closed" {{$lead->lead_status == "closed" ? "selected": ""}}>Closed</option>
                                                <option value="not_closed" {{$lead->lead_status == "not_closed" ? "selected": ""}}>Not closed</option>
                                                <option value="no_interests" {{$lead->lead_status == "no_interests" ? "selected": ""}}>No interests</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        @php
                                            $interested_in = explode(',', $lead->interested_in)
                                        @endphp
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Ich interessiere mich für
                                        </label>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input name="ld-interesse1" type="checkbox" class="form-check-input interested_in_data" id="validationCustom02" value="Investments in einen PreSale" {{in_array('Investments in einen PreSale', $interested_in) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom02">Investments in einen PreSale</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-interesse2" type="checkbox" class="form-check-input interested_in_data" id="validationCustom03" value="Investments in NFTs" {{in_array('Investments in NFTs', $interested_in) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom03">Investments in NFTs</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-interesse3" type="checkbox" class="form-check-input interested_in_data" id="validationCustom04" value="Investments in Krypto" {{in_array('Investments in Krypto', $interested_in) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom04">Investments in Krypto</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-interesse4" type="checkbox" class="form-check-input interested_in_data" id="validationCustom05" value="Kostenlose Krypto-Beratung" {{in_array('Kostenlose Krypto-Beratung', $interested_in) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom05">Kostenlose Krypto-Beratung</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-interesse5" type="checkbox" class="form-check-input interested_in_data" id="validationCustom06" value="Kostenlose NFT-Beratung" {{in_array('Kostenlose NFT-Beratung', $interested_in) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom06">Kostenlose NFT-Beratung</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-interesse6" type="checkbox" class="form-check-input interested_in_data" id="validationCustom07" value="Etwas anderes" {{in_array('Etwas anderes', $interested_in) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom07">Etwas anderes</label>
                                                </div>
                                            </div>

                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom08">Anrede
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="gender" class="default-select wide form-control" id="validationCustom08">
                                                <option class="selectopt" data-display="Select" value="Not selected">Please select</option>
                                                <option value="Frau" {{$lead->gender == "Frau" ? "selected": ""}}>Frau</option>
                                                <option value="Herr" {{$lead->gender == "Herr" ? "selected": ""}}>Herr</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom09">Vorname
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="first_name" type="text" value="{{$lead->first_name}}" class="form-control" id="validationCustom09" placeholder="e.g. John" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom10">Nachname
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="last_name" value="{{$lead->last_name}}" type="text" class="form-control" id="validationCustom10" placeholder="e.g. Doe" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid surname.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row disnon">
                                        <label class="col-lg-4 col-form-label">User
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="ld-email" type="text" class="form-control" value="Raphael Zumsteg">
                                        </div>
                                    </div>

                                    <div class="mb-3 row disnon">
                                        <label class="col-lg-4 col-form-label">Date
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="ld-date" type="text" class="form-control" value="01/12/2022">
                                        </div>
                                    </div>

                                    <div class="mb-3 row disnon">
                                        <label class="col-lg-4 col-form-label">Time
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="ld-time" type="text" class="form-control" value="13:45">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom11">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="email" value="{{$lead->email}}" type="text" class="form-control" id="validationCustom11" placeholder="e.g. john@mail.com" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom12">Telefonnummer
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input name="phone" value="{{$lead->phone}}" type="text" class="form-control" id="validationCustom12" placeholder="e.g. +41798765432" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid phone number.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom13">Investitionsbetrag
                                        </label>
                                        <div class="col-lg-6">
                                            <select name="investment_amount" class="default-select wide form-control" id="validationCustom13">
                                                <option value="">Please select</option>
                                                <option value="< 5'000" {{$lead->investment_amount == "< 5'000" ? "selected": ""}}>< 5'000</option>
                                                <option value="5'000 - 10'000" {{$lead->investment_amount == "5'000 - 10'000" ? "selected": ""}}>5'000 - 10'000</option>
                                                <option value="10'000 - 20'000" {{$lead->investment_amount == "10'000 - 20'000" ? "selected": ""}}>10'000 - 20'000</option>
                                                <option value="20'000 - 50'000" {{$lead->investment_amount == "20'000 - 50'000" ? "selected": ""}}>20'000 - 50'000</option>
                                                <option value="50'000 - 100'000" {{$lead->investment_amount == "50'000 - 100'000" ? "selected": ""}}>50'000 - 100'000</option>
                                                <option value="> 100'000" {{$lead->investment_amount == "> 100'000" ? "selected": ""}}>> 100'000</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom14">Erreichbarkeit
                                        </label>
                                        @php
                                            $reachability = explode(',', $lead->reachability)
                                        @endphp
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input name="ld-erreichbarkeit1" type="checkbox" class="form-check-input reachability-data" id="validationCustom15" value="Vormittags" {{in_array('Vormittags', $reachability) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom15">Vormittags</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-erreichbarkeit2" type="checkbox" class="form-check-input reachability-data" id="validationCustom16" value="Nachmittags" {{in_array('Nachmittags', $reachability) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom16">Nachmittags</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="ld-erreichbarkeit3" type="checkbox" class="form-check-input reachability-data" id="validationCustom17" value="Abends" {{in_array('Abends', $reachability) ? "checked": ""}}>
                                                    <label class="form-check-label" for="validationCustom17">Abends</label>
                                                </div>
                                            </div>

                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom18">Hinweis
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea name="notice" class="form-control" id="validationCustom18"  rows="5" placeholder="Möchten Sie uns noch etwas mitteilen?">{{$lead->notice}}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter a Suggestions.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-lg-8 ms-auto">
                                            <button type="button" onclick="addUpdateLead(this)" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
                @php
                    $url = route('admin.lead-create-update');
                @endphp
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create lead</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate >
                                <div class="alert alert-danger d-none"></div>
                                <div class="alert alert-success d-none"></div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom00">Lead status
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="lead_status" class="default-select wide form-control" id="validationCustom00">
                                                    <option class="selectopt" data-display="Select" value="unprocessed">Unprocessed</option>
                                                    <option value="appointment">Appointment</option>
                                                    <option value="not_reached_1">Not reached 1</option>
                                                    <option value="not_reached_2">Not reached 2</option>
                                                    <option value="not_reached_3">Not reached 3</option>
                                                    <option value="not_reached_4">Not reached 4</option>
                                                    <option value="not_reached_5">Not reached 5</option>
                                                    <option value="deadline">Deadline</option>
                                                    <option value="closed">Closed</option>
                                                    <option value="not_closed">Not closed</option>
                                                    <option value="no_interests">No interests</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01">Ich interessiere mich für
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input name="ld-interesse1" type="checkbox" class="form-check-input interested_in_data" id="validationCustom02" value="Investments in einen PreSale">
                                                        <label class="form-check-label" for="validationCustom02">Investments in einen PreSale</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-interesse2" type="checkbox" class="form-check-input interested_in_data" id="validationCustom03" value="Investments in NFTs">
                                                        <label class="form-check-label" for="validationCustom03">Investments in NFTs</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-interesse3" type="checkbox" class="form-check-input interested_in_data" id="validationCustom04" value="Investments in Krypto">
                                                        <label class="form-check-label" for="validationCustom04">Investments in Krypto</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-interesse4" type="checkbox" class="form-check-input interested_in_data" id="validationCustom05" value="Kostenlose Krypto-Beratung">
                                                        <label class="form-check-label" for="validationCustom05">Kostenlose Krypto-Beratung</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-interesse5" type="checkbox" class="form-check-input interested_in_data" id="validationCustom06" value="Kostenlose NFT-Beratung">
                                                        <label class="form-check-label" for="validationCustom06">Kostenlose NFT-Beratung</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-interesse6" type="checkbox" class="form-check-input interested_in_data" id="validationCustom07" value="Etwas anderes">
                                                        <label class="form-check-label" for="validationCustom07">Etwas anderes</label>
                                                    </div>
                                                </div>

                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom08">Anrede
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="gender" class="default-select wide form-control" id="validationCustom08">
                                                    <option class="selectopt" data-display="Select" value="Not selected">Please select</option>
                                                    <option value="Frau">Frau</option>
                                                    <option value="Herr">Herr</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom09">Vorname
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="first_name" type="text" class="form-control" id="validationCustom09" placeholder="e.g. John" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom10">Nachname
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="last_name" type="text" class="form-control" id="validationCustom10" placeholder="e.g. Doe" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid surname.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row disnon">
                                            <label class="col-lg-4 col-form-label">User
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="ld-name" type="text" class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="mb-3 row disnon">
                                            <label class="col-lg-4 col-form-label">Date
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="ld-date" type="text" class="form-control" value="01/12/2022">
                                            </div>
                                        </div>

                                        <div class="mb-3 row disnon">
                                            <label class="col-lg-4 col-form-label">Time
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="ld-time" type="text" class="form-control" value="13:45">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="email" type="text" class="form-control" id="validationCustom11" placeholder="e.g. john@mail.com" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom12">Telefonnummer
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="phone" type="text" class="form-control" id="validationCustom12" placeholder="e.g. +41798765432" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid phone number.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom13">Investitionsbetrag
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="investment_amount" class="default-select wide form-control" id="validationCustom13">
                                                    <option class="selectopt" data-display="Select" value="Not selected">Please select</option>
                                                    <option value="< 5'000">< 5'000</option>
                                                    <option value="5'000 - 10'000">5'000 - 10'000</option>
                                                    <option value="10'000 - 20'000">10'000 - 20'000</option>
                                                    <option value="20'000 - 50'000">20'000 - 50'000</option>
                                                    <option value="50'000 - 100'000">50'000 - 100'000</option>
                                                    <option value="> 100'000">> 100'000</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom14">Erreichbarkeit
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input name="ld-erreichbarkeit1" type="checkbox" class="form-check-input reachability-data" id="validationCustom15" value="Vormittags">
                                                        <label class="form-check-label" for="validationCustom15">Vormittags</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-erreichbarkeit2" type="checkbox" class="form-check-input reachability-data" id="validationCustom16" value="Nachmittags">
                                                        <label class="form-check-label" for="validationCustom16">Nachmittags</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input name="ld-erreichbarkeit3" type="checkbox" class="form-check-input reachability-data" id="validationCustom17" value="Abends">
                                                        <label class="form-check-label" for="validationCustom17">Abends</label>
                                                    </div>
                                                </div>

                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom18">Hinweis
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea name="notice" class="form-control" id="validationCustom18"  rows="5" placeholder="Möchten Sie uns noch etwas mitteilen?"></textarea>
                                                <div class="invalid-feedback">
                                                    Please enter a Suggestions.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="button" onclick="addUpdateLead(this)" class="btn btn-primary">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function addUpdateLead(input){
            $(input).attr('disabled', true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            $('.alert-danger').addClass('d-none').empty("");
            $('.alert-success').addClass('d-none').empty("");
            let interested_in = [];
            let reachability = [];
            $.each($('.interested_in_data'), function(k,v){
                if($(v).is(':checked')){
                    interested_in.push($(v).val())
                }
            });
            $.each($('.reachability-data'), function(k,v){
                if($(v).is(':checked')){
                    reachability.push($(v).val())
                }
            });
            let data = new FormData();
            data.append('lead_status', $('select[name=lead_status]').find(':selected').val());
            data.append('interested_in', interested_in);
            data.append('gender', $('select[name=gender]').find(':selected').val());
            data.append('investment_amount', $('select[name=investment_amount]').find(':selected').val());
            data.append('first_name', $('input[name=first_name]').val());
            data.append('last_name', $('input[name=last_name]').val());
            data.append('email', $('input[name=email]').val());
            data.append('phone', $('input[name=phone]').val());
            data.append('notice', $('textarea[name=notice]').val());
            data.append('reachability', reachability);
            axios.post('{{$url}}', data).then(function(res){
                if(res.data.status == 'success'){
                    $('.alert-success').removeClass('d-none').html(res.data.message);
                    setTimeout(function(){
                        window.location.reload()
                    }, 2500);
                }
            }).catch(function(error){
                if(error.response.status == 422){
                    $.each(error.response.data.errors, function(key, value){
                        $('input[name="'+key+'"]').addClass('has-error').after('<span class="text-danger">'+value[0]+'</span>');
                    });
                }
            }).finally(function(){
                $(input).attr('disabled', false);
            });

        }
    </script>
@endpush