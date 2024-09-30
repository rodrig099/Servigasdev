<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://checkout.epayco.co/checkout.js"></script>
</head>
<body>
    <form id="payment-form">
        <!-- Campos del formulario -->
        <input type="text" name="doc_type" placeholder="Document Type">
        <input type="text" name="doc_number" placeholder="Document Number">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="last_name" placeholder="Last Name">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="bill" placeholder="Bill">
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="value" placeholder="Value" value="5000">
        <input type="text" name="tax" placeholder="Tax" value="500">
        <input type="text" name="tax_base" placeholder="Tax Base" value="4500">
        <input type="text" name="currency" value="COP" readonly>
        <button type="button" id="pay-button">Pay</button>
    </form>

    <script>
        var handler = ePayco.checkout.configure({
            key: '4fedd7f52621ba75db369876657c8a88',
            test: true // Cambia a false cuando estés en producción
        });

        document.getElementById('pay-button').addEventListener('click', function (e) {
            e.preventDefault();

            var data = {
                name: document.querySelector('input[name="description"]').value,
                description: document.querySelector('input[name="description"]').value,
                invoice: document.querySelector('input[name="bill"]').value,
                currency: 'cop',
                amount: document.querySelector('input[name="value"]').value,
                tax_base: document.querySelector('input[name="tax_base"]').value,
                tax: document.querySelector('input[name="tax"]').value,
                country: 'co',
                lang: 'en',
                external: 'false',
                extra1: 'extra1',
                extra2: 'extra2',
                extra3: 'extra3',
                confirmation: 'http://secure2.payco.co/prueba_curl.php',
                response: 'http://secure2.payco.co/prueba_curl.php',
                name_billing: document.querySelector('input[name="name"]').value,
                address_billing: 'Carrera 19 numero 14 91',
                type_doc_billing: document.querySelector('input[name="doc_type"]').value,
                mobilephone_billing: '3050000000',
                number_doc_billing: document.querySelector('input[name="doc_number"]').value,
                email_billing: document.querySelector('input[name="email"]').value
            };

            handler.open(data);
        });
    </script>
</body>
</html>
