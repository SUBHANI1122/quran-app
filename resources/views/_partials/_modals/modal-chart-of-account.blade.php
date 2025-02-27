@php
function renderFirstParentAsHeadingAndAllLastChildren($classification) {
    $firstParents = $classification->where('parent_id', null);

    foreach ($firstParents as $parent) {
        echo '<optgroup label="' . htmlspecialchars($parent->name) . '"></optgroup>';

        renderLastChildrenOfParent($classification, $parent->id, 1);
    }
}

function renderLastChildrenOfParent($classification, $parent_id, $level = 1) {
    $children = $classification->where('parent_id', $parent_id);

    foreach ($children as $child) {
        if (isLastChild($classification, $child->id)) {
            $indent = str_repeat('&nbsp;', $level * 4); 

            echo '<option value="' . $child->id . '">' . $indent . htmlspecialchars($child->name) . '</option>';
        } else {
            renderLastChildrenOfParent($classification, $child->id, $level + 1);
        }
    }
}

function isLastChild($classification, $parent_id) {
    $children = $classification->where('parent_id', $parent_id);

    return $children->isEmpty();
}
@endphp
<div class="modal fade" id="addChartofAccount" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-currency">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2" id="offcanvasAddUserLabel">Edit Currency</h4>
                </div>
                <form id="addChartOfAccountForm" class="row g-6">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="currency">Parent Account</label>
                        <select id="parent_account_id" name="parent_account_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            @php
                            renderFirstParentAsHeadingAndAllLastChildren($classifications);
                            @endphp
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="symbol">Account Name</label>
                        <input type="text" id="account" name="account_name" class=" form-control" placeholder="" value="" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Prefix</label>
                        <input type="text" id="prefixs" name="prefix" class="form-control" placeholder="" value="" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="currency">Country Name</label>
                        <select id="currency_id" name="currency_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            @foreach ($currencies as $currency)
                            <option value="{{$currency->id}}" data-symbol="{{$currency->currency}}" data-name="{{$currency->name}}">{{$currency->country}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Currency</label>
                        <input type="text" id="currency_symbol" name="currency_symbol" class="form-control" placeholder="" value="" readonly/>
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label" for="type">Re Value</label>
                        <select id="re_value" name="re_value" class="select2 form-select" aria-label="Default select example">
                            <option value="">Select Type</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="select2 form-select" aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="re_value">Is Cost of Sales ?</label>
                        <select id="cost_of_sale" name="cost_of_sale" class="select2 form-select" aria-label="Default select example">
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Debit Limit</label>
                        <input type="number" id="debit_limit" name="debit_limit" class="form-control" placeholder="" value="" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Credit Limit</label>
                        <input type="number" id="credit_limit" name="credit_limit" class="form-control" placeholder="" value="" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="re_value">Account Type</label>
                        <select id="account_type" name="account_type" class="select2 form-select" aria-label="Default select example">
                            <option value="">-- Select --</option>
                            <option value="buyer">Buyer</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="re_value">SC or DC</label>
                        <select id="sc_dc" name="sc_dc" class="select2 form-select" aria-label="Default select example">
                            <option value="">-- Select --</option>
                            <option value="SC">SC</option>
                            <option value="DC">DC</option>
                        </select>
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