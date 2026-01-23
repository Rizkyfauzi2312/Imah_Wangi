@extends('layouts.main')

@section('title', 'Custom Perfume Builder - Valoria Parfume')

@section('content')
<div class="custom-perfume-container">
    <div class="container py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="display-4" style="color: var(--color-gold); font-weight: 700;">Create Your Signature Scent</h1>
            <p class="lead text-muted">Build a unique fragrance that reflects your personality</p>
            <div class="divider-gold mx-auto"></div>
        </div>

        <form action="{{ route('cart.add') }}" method="POST" id="custom-perfume-form">
            @csrf
            <input type="hidden" name="is_custom" value="1">
            <input type="hidden" name="product_name" id="product-name" value="Custom Perfume">
            <input type="hidden" name="price" id="final-price" value="0">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="selected_aromas" id="selected-aromas" value="">

            <div class="row">
                <!-- Left Column - Aroma Selection -->
                <div class="col-lg-8">
                    <!-- Top Notes -->
                    <div class="aroma-section mb-4">
                        <div class="section-header">
                            <i class="fas fa-star"></i>
                            <h3>Top Notes</h3>
                            <p>The first impression - light and refreshing</p>
                        </div>
                        <div class="row g-3">
                            @foreach($aromas['top'] ?? [] as $aroma)
                                <div class="col-md-6">
                                    <div class="aroma-card" data-aroma-id="{{ $aroma->id }}" data-category="top" data-price="{{ $aroma->price }}">
                                        <div class="aroma-card-content">
                                            <div class="aroma-info">
                                                <h5>{{ $aroma->name }}</h5>
                                                <p class="text-muted small mb-0">{{ $aroma->description }}</p>
                                            </div>
                                            <div class="aroma-price">
                                                <span class="price-tag">+Rp {{ number_format($aroma->price, 0, ',', '.') }}</span>
                                                <div class="check-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="checkbox" name="custom_notes[top][]" value="{{ $aroma->id }}" class="d-none aroma-checkbox">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Middle Notes -->
                    <div class="aroma-section mb-4">
                        <div class="section-header">
                            <i class="fas fa-heart"></i>
                            <h3>Middle Notes</h3>
                            <p>The heart of the fragrance - floral and rich</p>
                        </div>
                        <div class="row g-3">
                            @foreach($aromas['middle'] ?? [] as $aroma)
                                <div class="col-md-6">
                                    <div class="aroma-card" data-aroma-id="{{ $aroma->id }}" data-category="middle" data-price="{{ $aroma->price }}">
                                        <div class="aroma-card-content">
                                            <div class="aroma-info">
                                                <h5>{{ $aroma->name }}</h5>
                                                <p class="text-muted small mb-0">{{ $aroma->description }}</p>
                                            </div>
                                            <div class="aroma-price">
                                                <span class="price-tag">+Rp {{ number_format($aroma->price, 0, ',', '.') }}</span>
                                                <div class="check-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="checkbox" name="custom_notes[middle][]" value="{{ $aroma->id }}" class="d-none aroma-checkbox">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Base Notes -->
                    <div class="aroma-section mb-4">
                        <div class="section-header">
                            <i class="fas fa-anchor"></i>
                            <h3>Base Notes</h3>
                            <p>The foundation - warm and long-lasting</p>
                        </div>
                        <div class="row g-3">
                            @foreach($aromas['base'] ?? [] as $aroma)
                                <div class="col-md-6">
                                    <div class="aroma-card" data-aroma-id="{{ $aroma->id }}" data-category="base" data-price="{{ $aroma->price }}">
                                        <div class="aroma-card-content">
                                            <div class="aroma-info">
                                                <h5>{{ $aroma->name }}</h5>
                                                <p class="text-muted small mb-0">{{ $aroma->description }}</p>
                                            </div>
                                            <div class="aroma-price">
                                                <span class="price-tag">+Rp {{ number_format($aroma->price, 0, ',', '.') }}</span>
                                                <div class="check-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="checkbox" name="custom_notes[base][]" value="{{ $aroma->id }}" class="d-none aroma-checkbox">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column - Bottle Size & Summary -->
                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <!-- Bottle Size Selection -->
                        <div class="bottle-section mb-4">
                            <h4 class="mb-3"><i class="fas fa-wine-bottle me-2" style="color: var(--color-gold);"></i>Bottle Size</h4>
                            @foreach($bottleSizes as $size)
                                <div class="bottle-option mb-2">
                                    <input type="radio" name="bottle_size_id" value="{{ $size->id }}" id="size-{{ $size->id }}" data-price="{{ $size->base_price }}" class="d-none bottle-radio">
                                    <label for="size-{{ $size->id }}" class="bottle-label">
                                        <div class="bottle-info">
                                            <span class="bottle-size">{{ $size->size_ml }}ml</span>
                                            <span class="bottle-price">Rp {{ number_format($size->base_price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="bottle-check">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Summary -->
                        <div class="price-summary-card">
                            <h4 class="mb-3">Price Summary</h4>
                            <div class="summary-item">
                                <span>Bottle Size:</span>
                                <span id="bottle-price-display">Rp 0</span>
                            </div>
                            <div class="summary-item">
                                <span>Selected Aromas (<span id="aroma-count">0</span>):</span>
                                <span id="aroma-price-display">Rp 0</span>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-total">
                                <span>Total Price:</span>
                                <span id="total-price-display">Rp 0</span>
                            </div>
                            
                            <button type="button" id="add-to-cart-custom" class="btn btn-gold w-100 mt-3">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <a href="{{ route('shop.index') }}" class="btn btn-black w-100 mt-2">
                                <i class="fas fa-arrow-left me-2"></i>Browse Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.custom-perfume-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.custom-perfume-container h1 {
    color: #1a1a1a !important;
}

.custom-perfume-container .lead {
    color: #6c757d !important;
}

.divider-gold {
    width: 100px;
    height: 3px;
    background: var(--color-gold);
    margin-top: 20px;
}

.aroma-section {
    background: #ffffff;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.section-header {
    margin-bottom: 20px;
}

.section-header i {
    color: var(--color-gold);
    font-size: 1.5rem;
    margin-right: 10px;
}

.section-header h3 {
    color: #1a1a1a;
    display: inline;
    font-size: 1.5rem;
    font-weight: 600;
}

.section-header p {
    color: #6c757d;
    margin-top: 5px;
    margin-bottom: 0;
}

.aroma-card {
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 10px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.aroma-card:hover {
    border-color: var(--color-gold);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    background: #fff;
}

.aroma-card.selected {
    border-color: var(--color-gold);
    background: #fff9e6;
    box-shadow: 0 3px 10px rgba(212, 175, 55, 0.2);
}

.aroma-card-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.aroma-info h5 {
    color: #1a1a1a;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.aroma-info p {
    color: #6c757d !important;
}

.aroma-price {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.price-tag {
    color: var(--color-gold);
    font-weight: 700;
    font-size: 0.95rem;
}

.check-icon {
    width: 28px;
    height: 28px;
    border: 2px solid #dee2e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 5px;
    transition: all 0.3s ease;
    background: #fff;
}

.aroma-card.selected .check-icon {
    background: var(--color-gold);
    border-color: var(--color-gold);
}

.aroma-card.selected .check-icon i {
    color: #fff;
}

.check-icon i {
    font-size: 14px;
    color: transparent;
}

.aroma-card.selected .check-icon i {
    color: #fff;
}

.sticky-sidebar {
    position: sticky;
    top: 100px;
}

.bottle-section {
    background: #ffffff;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.bottle-section h4 {
    color: #1a1a1a;
}

.bottle-option {
    position: relative;
}

.bottle-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 12px 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 0;
}

.bottle-label:hover {
    border-color: var(--color-gold);
    background: #fff;
}

.bottle-radio:checked + .bottle-label {
    border-color: var(--color-gold);
    background: #fff9e6;
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.2);
}

.bottle-info {
    display: flex;
    flex-direction: column;
}

.bottle-size {
    color: #1a1a1a;
    font-weight: 700;
    font-size: 1.1rem;
}

.bottle-price {
    color: var(--color-gold);
    font-size: 0.9rem;
    font-weight: 600;
}

.bottle-check {
    color: transparent;
    transition: all 0.3s ease;
    font-size: 1.3rem;
}

.bottle-radio:checked + .bottle-label .bottle-check {
    color: var(--color-gold);
}

.price-summary-card {
    background: #ffffff;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.price-summary-card h4 {
    color: #1a1a1a;
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--color-gold);
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    color: #495057;
    font-size: 0.95rem;
}

.summary-item span:first-child {
    color: #6c757d;
}

.summary-item span:last-child {
    color: #1a1a1a;
    font-weight: 600;
}

.summary-divider {
    height: 2px;
    background: linear-gradient(to right, transparent, var(--color-gold), transparent);
    margin: 15px 0;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    padding: 15px 0;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--color-gold);
}

.summary-total span:first-child {
    color: #1a1a1a;
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    let selectedAromas = [];
    let bottlePrice = 0;
    let aromaPrice = 0;

    // Aroma selection
    $('.aroma-card').click(function() {
        const aromaId = $(this).data('aroma-id');
        const price = parseFloat($(this).data('price'));
        const checkbox = $(this).find('.aroma-checkbox');
        
        if ($(this).hasClass('selected')) {
            // Deselect
            $(this).removeClass('selected');
            checkbox.prop('checked', false);
            selectedAromas = selectedAromas.filter(a => a.id !== aromaId);
            aromaPrice -= price;
        } else {
            // Select
            $(this).addClass('selected');
            checkbox.prop('checked', true);
            selectedAromas.push({id: aromaId, price: price});
            aromaPrice += price;
        }
        
        updatePriceSummary();
    });

    // Bottle size selection
    $('input[name="bottle_size_id"]').change(function() {
        bottlePrice = parseFloat($(this).data('price'));
        updatePriceSummary();
    });

    function updatePriceSummary() {
        const totalPrice = bottlePrice + aromaPrice;
        
        $('#bottle-price-display').text('Rp ' + bottlePrice.toLocaleString('id-ID'));
        $('#aroma-count').text(selectedAromas.length);
        $('#aroma-price-display').text('Rp ' + aromaPrice.toLocaleString('id-ID'));
        $('#total-price-display').text('Rp ' + totalPrice.toLocaleString('id-ID'));
        $('#final-price').val(totalPrice);
        
        // Update product name with details
        const aromaNames = selectedAromas.map(a => {
            const card = $(`.aroma-card[data-aroma-id="${a.id}"]`);
            return card.find('h5').text();
        }).join(', ');
        
        const bottleSize = $('input[name="bottle_size_id"]:checked').closest('.bottle-label').find('.bottle-size').text();
        const productName = `Custom Perfume ${bottleSize} - ${aromaNames}`;
        $('#product-name').val(productName);
        $('#selected-aromas').val(JSON.stringify(selectedAromas));
    }

    // Add to cart
    $('#add-to-cart-custom').click(function(e) {
        e.preventDefault();
        
        if (!$('input[name="bottle_size_id"]:checked').length) {
            alert('Please select a bottle size');
            return;
        }
        
        if (selectedAromas.length === 0) {
            alert('Please select at least one aroma');
            return;
        }
        
        $('#custom-perfume-form').submit();
    });
});
</script>
@endpush
@endsection
