function handleCheckboxChange(checkbox) {
   var selectedValues = checkbox.value;

   var currentURL = window.location.href;

   var newURL = currentURL.split('?')[0]+   "?" + selectedValues;
   
   // Chuyển hướng trang với URL mới
   window.location.href = newURL;
 }