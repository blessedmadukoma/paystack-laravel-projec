const paymentForm = document.getElementById('paymentForm');
  paymentForm.addEventListener("submit", payWithPaystack, false);

  var email = document.getElementById("email_address").value;
  function payWithPaystack(e) {
    e.preventDefault();

    // If checkbox is checked, do this, else, tell them to confirm...
    checkbox = document.getElementById("accept");
    console.log(checkbox.checked);
    if (!checkbox.checked) {
      alert("You must check the box - confirm your information is correct before checking the box!")
    } else {

    let handler = PaystackPop.setup({
      key: 'pk_test_14ba7262cb3ddc92492b6977c10229a948e67b8c', // Replace with your public key
      email: email,
      amount: 21500 * 100,
      firstname: document.getElementById("first_name").value,
      lastname: document.getElementById("last_name").value,
      phone: document.getElementById("phone").value,
      ref: 'VS' + Math.floor((Math.random() * 1000000000) +
        1
      ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

      callback: function(response) {

        var reference = response.reference;
        let message = 'Payment complete! Reference: ' + reference;
        alert(message);

        window.location = "http://localhost/unkulray/payment/verify_transaction.php?reference=" + reference;
      },
      onClose: function() {
        window.location = "http://localhost/unkulray/payment/index.php?transaction=cancel",
          alert('Transaction not completed.');
      },
    });
    handler.openIframe();
  }
  }