document.addEventListener('DOMContentLoaded', function () {
    function fetchCustomerDetails() {
        var customerId = document.getElementById('customer_id').value;
        if (!customerId) {
            document.getElementById('customerDetails').style.display = 'none';
            return;
        }
        fetch('/api/customers/' + customerId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('customerEmail').textContent = data.email;
                document.getElementById('customerPhone').textContent = data.phone;
                document.getElementById('customerDetails').style.display = 'block';
            })
            .catch(error => console.error('Error fetching customer details:', error));
    }

    document.getElementById('customer_id').addEventListener('change', fetchCustomerDetails);

    function adjustQuantity(action, productId) {
        let input = document.getElementById('qty' + productId);
        let currentQuantity = parseInt(input.value);
        if (action === 'increase') {
            input.value = currentQuantity + 1;
        } else if (action === 'decrease' && currentQuantity > 0) {
            input.value = currentQuantity - 1;
        }
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        const productPrices = @json($products->pluck('price', 'id')->toArray());
        document.querySelectorAll('.quantity-input').forEach(input => {
            const productId = input.name.split('[')[1].split(']')[0];
            const quantity = parseInt(input.value);
            if (productPrices[productId]) {
                const itemTotal = quantity * parseFloat(productPrices[productId]);
                total += itemTotal;
            }
        });
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    window.adjustQuantity = adjustQuantity;
});