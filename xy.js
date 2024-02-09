
      document.addEventListener('DOMContentLoaded', function () {
        const phoneNumbers = document.querySelectorAll('.phone-number');
    
        phoneNumbers.forEach(function (phoneNumber) {
          phoneNumber.addEventListener('click', function () {
            // Create a dummy text area to copy the phone number to clipboard
            const dummyTextArea = document.createElement('textarea');
            dummyTextArea.value = phoneNumber.getAttribute('data-phone');
            document.body.appendChild(dummyTextArea);
    
            // Select and copy the phone number
            dummyTextArea.select();
            document.execCommand('copy');
    
            // Remove the dummy text area
            document.body.removeChild(dummyTextArea);
    
            // You can provide some visual feedback or alert the user here
            alert('Phone number copied to clipboard: ' + phoneNumber.getAttribute('data-phone'));
          });
        });
      });
    