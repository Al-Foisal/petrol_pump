<tr data-bs-toggle="offcanvas" id="removeOrderDetails_{{ $single_product->id }}">
    <td>
        <div class="align-items-center">
            <div>
                <input class="form-control" type="text" name="product_name[]" id="product_name" readonly
                    value="{{ $single_product->name }}">
                <input type="hidden" name="product_id[]" value="{{ $single_product->id }}">
            </div>
        </div>
    </td>

    <td>
        <div class="align-items-center">
            <div>
                <input class="form-control" type="text" id="product_quantity_{{ $single_product->id }}"
                    name="product_quantity[]" value="1"
                    onkeyup="changeAmount(this,'{{ $single_product->price }}','{{ $single_product->id }}')">
                <input type="hidden" value="{{ $single_product->price }}" id="singlePrice_{{ $single_product->id }}">
            </div>
        </div>
    </td>

    <td>
        <div class="align-items-center">
            <div>
                <input class="form-control amount" type="text" id="product_amount_{{ $single_product->id }}"
                    onkeyup="changeLitter(this,'{{ $single_product->price }}','{{ $single_product->id }}')"
                    name="product_amount[]" value="{{ $single_product->price }}">
            </div>
        </div>
    </td>

    <td class="menu-status">
        <span class="danger" onclick="removeThisProduct('removeOrderDetails_{{ $single_product->id }}')"
            style="cursor: pointer;">
            <i class="ri-delete-bin-line"></i>
        </span>
    </td>
</tr>
