<!-- Edit User Modal -->
<div class="modal fade" id="addTransferEntry" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-currency">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2" id="offcanvasAddUserLabel">Edit Transfer Entry</h4>
                </div>
                <form id="addTransferEntryForm" class="row g-6">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">Posted Date</label>
                            <input type="date" class="form-control" name="posting_date" id="posting_date" readonly value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">Account Name</label>
                            <select id="account_id" name="account_id" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select</option>
                                @foreach ($accounts as $account)
                                <option value="{{$account->id}}" data-currency="{{$account->currency->currency}}">{{$account->account_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">Type</label>
                            <select id="type" name="type" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="debit">Debit</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">Rate</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11">@</span>
                                <input type="number" class="form-control" placeholder="rate" aria-label="rate" aria-describedby="basic-addon11" id="rate" name="rate" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">Fc</label>
                            <div class="input-group">
                                <span class="input-group-text" id="currency-symbol">@</span>
                                <input type="number" class="form-control" placeholder="fc" aria-label="fc" aria-describedby="basic-addon11" id="fc" name="fc" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">LC</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11">GBP</span>
                                <input type="number" class="form-control" placeholder="lc" aria-label="lc" aria-describedby="basic-addon11" id="lc" name="lc" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="currency">Decsription</label>
                            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->