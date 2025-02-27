<!-- Edit User Modal -->
@php
function renderClassificationOptions($classification, $parent_id = null, $level = 0) {
    foreach ($classification as $item) {
        if ($item->parent_id == $parent_id) {
            $indent = str_repeat('&nbsp;', $level * 4);

            $hasChildren = $classification->contains(function ($child) use ($item) {
                return $child->parent_id == $item->id;
            });

            // Disable only the 4th-level children
            $isDisabled = $level === 3 ? ' disabled' : '';

            echo '<option value="' . $item->id . '"' . $isDisabled . '>' 
                . $indent . htmlspecialchars($item->name) . '</option>';

            if ($hasChildren) {
                renderClassificationOptions($classification, $item->id, $level + 1);
            }
        }
    }
}
@endphp


<div class="modal fade" id="addAccountClassification" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-currency">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2" id="offcanvasAddUserLabel">Add Classification</h4>
                </div>
                <form id="addAccountClasssificationForm" class="row g-6">
                    <input type="hidden" name="account_classification_id" id="account_classification_id" value="">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="currency">Parent</label>
                        <select id="parent_id" name="parent_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            @php
                            renderClassificationOptions($classification);
                            @endphp
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
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="symbol">Name</label>
                        <input type="text" id="name" name="name" class=" form-control" placeholder="" value="" />
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