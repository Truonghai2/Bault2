
// Lấy ra phần tử chứa dropdown
const informations = document.getElementById('informations');
const dropdownUser = document.querySelector('.dropdown-user');

informations.addEventListener('click', function() {
  if (dropdownUser.style.display === 'none' || dropdownUser.style.display === '') {
    dropdownUser.style.display = 'block';
  } else {
    dropdownUser.style.display = 'none';
  }
});
document.addEventListener('click', function(event) {
  const isClickedInsideInformations = informations.contains(event.target);
  const isClickedInsideDropdownUser = dropdownUser.contains(event.target);
  if (!isClickedInsideInformations && !isClickedInsideDropdownUser) {
    dropdownUser.style.display = 'none';
  }
});



