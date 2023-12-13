<div class="form-card ">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">Bank Particulars:</h2>

        </div>
        <div class="col-5">
            <h2 class="steps">Step 4 - 7</h2>
        </div>

    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            {{-- <button id="addParticular" class="btn btn-primary float-right">Add Bank Particular</button> --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="btnAddBankParticular"
                data-bs-target="#addBankParticularModal">
                Add Bank Particular
            </button>
        </div>
    </div>
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-hover " id="tab_logic">
            <thead style="color:black; font-wight:bolder;">
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
                    <th>
                        PassBook
                    </th>
                    <th class="text-center">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($bankParticulars as $key => $bankParticular)
                    <tr id='addr0' data-id="0" class="hidden" style="cursor: move;">
                        <input type="hidden" name="bankParticular_id[]" value="{{ $bankParticular->id }}">
                        <td data-name="AccountyType">

                            {{ $bankParticular->Account_type }}
                        </td>
                        <td data-name="holder_name">

                            {{ $bankParticular->name }}

                        </td>
                        <td data-name="bank">

                            {{ $bankParticular->bank_name }}
                        </td>
                        <td data-name="branch">

                            {{ $bankParticular->branch }}

                        </td>

                        <td data-name="Account No">

                            {{ $bankParticular->account_no }}
                        </td>
                        <td>
                            PassBook
                        </td>
                        <td data-name="del">
                            <button name="del0" type="button"
                                class='btn btn-danger glyphicon glyphicon-remove row-remove'><span
                                    aria-hidden="true">X</span></button>
                        </td>
                    </tr>
                @empty
                    <tr id='addr0' data-id="0" class="hidden" style="cursor: move;">
                        <td colspan="7">
                            No Bank Particulars Entered!
                        </td>
                @endforelse
            </tbody>
        </table>

    </div>
    <br>
</div>
