<div class="form-card ">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">Bank Particulars:</h2>
        </div>
        <div class="col-5">
            <h2 class="steps">Step 4 - 6</h2>
        </div>
    </div>
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-hover table-sortable" id="tab_logic">
            <thead style="color:white; font-wight:bolder;">
                <tr>
                    <th class="text-center ">

                        A/C Type
                    </th>
                    <th class="text-center ">

                        Holders Name
                    </th>
                    <th class="text-center">
                        Bank Name
                    </th>
                    <th class="text-center">
                        Branch
                    </th>
                    <th class="text-center">
                        Account No
                    </th>
                    <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bankParticulars as $key => $bankParticular)
                    <tr id='addr0' data-id="0" class="hidden" style="cursor: move;">
                        <input type="hidden" name="bankParticular_id[]" value="{{ $bankParticular->id }}">
                        <td data-name="AccountyType">
                            <select name="accountType[]" class="accountType">
                                <option value="" {{ $bankParticular->Account_type == '' ? 'selected' : '' }}>
                                    Select
                                    Option</option>
                                <option value="Individual"
                                    {{ $bankParticular->Account_type == 'Individual' ? 'selected' : '' }}>Individual
                                </option>
                                <option value="Joint" {{ $bankParticular->Account_type == 'Joint' ? 'selected' : '' }}>
                                    Joint
                                </option>
                            </select>
                        </td>
                        <td data-name="holder_name">
                            <input type="text" name='holder_name[]' placeholder='Holder Name' class="form-control"
                                value="{{ $bankParticular->name }}" />
                        </td>
                        <td data-name="bank">
                            <select type="text" name='bank[]' placeholder='Bank Name' class="form-control bank">
                                <option value="0">Select Bank</option>
                                @if ($banks)
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->name }}"
                                            {{ $bankParticular->bank_name == $bank->name ? 'selected' : '' }}>
                                            {{ $bank->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td data-name="branch">
                            @php
                                $branches = App\Bank::where('name', $bankParticular->bank_name)
                                    ->first()
                                    ->branches()
                                    ->get();
                            @endphp

                            <select type="text" name='branch[]' placeholder='Branch' class="form-control branch">
                                <option value="0">Select Branch</option>
                                @foreach ($branches as $key => $branch)
                                    <option value="{{ $branch->name }}"
                                        {{ $branch->name == $bankParticular->branch ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td data-name="Account No">
                            <input type="text" name='accountno[]' placeholder='Account no' class="form-control"
                                value="{{ $bankParticular->account_no }}" />
                        </td>
                        <td data-name="del">
                            <button name="del0" type="button"
                                class='btn btn-danger glyphicon glyphicon-remove row-remove'><span
                                    aria-hidden="true">×</span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a id="add_row" class="btn btn-primary float-right">Add</a>
    </div>
    <br>
</div>
