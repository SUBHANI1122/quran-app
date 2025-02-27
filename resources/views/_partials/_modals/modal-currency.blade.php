<!-- Edit User Modal -->
<div class="modal fade" id="addCurrency" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-currency">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2" id="offcanvasAddUserLabel">Edit Currency</h4>
                </div>
                <form id="addCurrencyForm" class="row g-6">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="currency">Currency Name</label>
                        <select id="currency_id" name="currency_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            @foreach ($currencies as $currency)
                            <option value="{{$currency->id}}" data-symbol="{{$currency->currency}}" data-country="{{$currency->country}}">{{$currency->currency}} - {{$currency->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="symbol">Symbol</label>
                        <input type="text" id="symbol" name="symbol" class=" form-control" placeholder="" value=""  readonly/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Country</label>
                        <input type="text" id="country" name="country" class="form-control" placeholder="" value="" readonly/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="type">Type</label>
                        <select id="type" name="type" class="select2 form-select" aria-label="Default select example">
                            <option value="">Select Type</option>
                            <option value="0">Divide</option>
                            <option value="1">Multiply</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="select2 form-select" aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="re_value">Re Value</label>
                        <select id="re_value" name="re_value" class="select2 form-select" aria-label="Default select example">
                            <option value="">Select Re-value</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="profit">Profit</label>
                        <select id="profit" name="profit" class="select2 form-select" aria-label="Default select example">
                            <option value="">Select Profit</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Minimum Rate Limit</label>
                        <input type="text" id="min_rate_limit" name="min_rate_limit" class="form-control" placeholder="" value="" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Maximum Rate Limit</label>
                        <input type="text" id="max_rate_limit" name="max_rate_limit" class="form-control" placeholder="" value="" />
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="auto_create_unpaid_tranx_account" name="auto_create_unpaid_tranx_account" />
                            <label for="auto_create_unpaid_tranx_account" class="switch-label">Auto create Unpaid Tranx Account:</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="auto_create_unearned_admin_service_fee_account" name="auto_create_unearned_admin_service_fee_account" />
                            <label for="auto_create_unearned_admin_service_fee_account" class="switch-label">Auto create Un-Earned Admin Service Fee Account:</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="auto_create_unearned_agent_service_fee_account" name="auto_create_unearned_agent_service_fee_account" />
                            <label for="auto_create_unearned_agent_service_fee_account" class="switch-label">Auto create Un-Earned Agent Service Fee Account:</label>
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