// Custom Perfume Builder - Real-time Price Calculator

$(document).ready(function () {
    let selectedNotes = {
        top: [],
        middle: [],
        base: []
    };

    let selectedBottleSize = null;
    let bottleSizePrice = 0;

    // Aroma selection
    $('.aroma-item').click(function () {
        const aromaId = $(this).data('aroma-id');
        const category = $(this).data('category');

        if ($(this).hasClass('selected')) {
            // Deselect
            $(this).removeClass('selected');
            const index = selectedNotes[category].indexOf(aromaId);
            if (index > -1) {
                selectedNotes[category].splice(index, 1);
            }
        } else {
            // Select
            $(this).addClass('selected');
            selectedNotes[category].push(aromaId);
        }

        updatePrice();
    });

    // Bottle size selection - FIXED: changed from bottle_size to bottle_size_id
    $('input[name="bottle_size_id"]').change(function () {
        selectedBottleSize = $(this).val();

        // Get price from data attribute or label
        const priceText = $(this).closest('.card-body').find('p.text-muted').text();
        const priceMatch = priceText.match(/Rp\s*([\d.,]+)/);
        if (priceMatch) {
            bottleSizePrice = parseInt(priceMatch[1].replace(/\./g, ''));
        }

        // Visual feedback
        $('.card-valoria').removeClass('border-warning');
        $(this).closest('.card-valoria').addClass('border-warning');

        updatePrice();
    });

    function updatePrice() {
        if (!selectedBottleSize) {
            $('#price-display').html('<span class="text-muted">Select bottle size to see price</span>');
            $('#final-price').val(0);
            return;
        }

        // Calculate total notes
        const totalNotes = selectedNotes.top.length + selectedNotes.middle.length + selectedNotes.base.length;

        // Base price from bottle size
        let totalPrice = bottleSizePrice;

        // Add 10k per note selected
        totalPrice += (totalNotes * 10000);

        // Update display
        const formattedPrice = 'Rp ' + totalPrice.toLocaleString('id-ID');
        $('#price-display').html(formattedPrice);
        $('#final-price').val(totalPrice);

        // Show breakdown if notes selected
        if (totalNotes > 0) {
            const breakdown = `<small class="d-block text-muted mt-2">
                Base: Rp ${bottleSizePrice.toLocaleString('id-ID')} + 
                ${totalNotes} notes (Rp ${(totalNotes * 10000).toLocaleString('id-ID')})
            </small>`;
            $('#price-display').append(breakdown);
        }
    }

    // Add to cart
    $('#add-to-cart-custom').click(function (e) {
        e.preventDefault();

        if (!selectedBottleSize) {
            alert('Please select a bottle size');
            return;
        }

        const totalNotes = selectedNotes.top.length + selectedNotes.middle.length + selectedNotes.base.length;
        if (totalNotes === 0) {
            alert('Please select at least one aroma note');
            return;
        }

        // Add quantity field if not exists
        if ($('input[name="quantity"]').length === 0) {
            $('#custom-perfume-form').append('<input type="hidden" name="quantity" value="1">');
        }

        // Submit form
        $('#custom-perfume-form').submit();
    });
});
