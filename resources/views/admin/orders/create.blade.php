@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.orders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.order.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.order.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_telepon">{{ trans('cruds.order.fields.no_telepon') }}</label>
                <input class="form-control {{ $errors->has('no_telepon') ? 'is-invalid' : '' }}" type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', '') }}" required>
                @if($errors->has('no_telepon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_telepon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.no_telepon_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="alamat">{{ trans('cruds.order.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="alamat" name="alamat" id="alamat" value="{{ old('alamat') }}" required>
                @if($errors->has('alamat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.order.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (in_array($product->id, old('products', [])) ? 'selected' : '') }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <div class="invalid-feedback">
                        {{ $errors->first('products') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.product_helper') }}</span>
            </div>
            <div id="quantity-container"></div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.pengiriman') }}</label>
                <select class="form-control {{ $errors->has('pengiriman') ? 'is-invalid' : '' }}" name="pengiriman" id="pengiriman">
                    @foreach(App\Models\Order::PENGIRIMAN as $key => $label)
                        <option value="{{ $key }}" {{ old('pengiriman', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('pengiriman'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pengiriman') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.pengiriman_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.order.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total') }}" step="0.01" readonly>
                @if($errors->has('total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    @foreach(App\Models\Order::STATUS as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productSelect = document.getElementById('products');
        const quantityContainer = document.getElementById('quantity-container');

        productSelect.addEventListener('change', function() {
            quantityContainer.innerHTML = '';
            for (let product of this.selectedOptions) {
                let quantityInput = document.createElement('input');
                quantityInput.type = 'number';
                quantityInput.name = `quantities[${product.value}]`;
                quantityInput.min = 1;
                quantityInput.placeholder = `Quantity for ${product.text}`;
                quantityContainer.appendChild(quantityInput);
            }
        });

        productSelect.dispatchEvent(new Event('change')); // To initialize the quantities on page load if any products are pre-selected
    });
</script>
@endsection
