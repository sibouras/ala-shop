// $(function () {
//   'use strict';
// });

// const addForm = document.getElementById('add-user-form');

// addForm.addEventListener('submit', (e) => {
//   e.preventDefault();
//   const formData = new FormData(addForm);
//   console.log(formData);

//   if (addForm.checkValidity() === false) {
//     e.preventDefault();
//     e.stopPropagation();
//     addForm.classList.add('was-validated');
//     return false;
//   } else {
//   }
// });

$(document).ready(function () {
  $('#datatableId').DataTable({
    // pagingType: 'full_numbers',
    // lengthMenu: [
    //   [10, 25, 50, -1],
    //   [10, 25, 50, 'All'],
    // ],
    responsive: true,
    language: {
      search: '_INPUT_',
      searchPlaceholder: 'Search records',
    },
    scrollY: '50vh',
    scrollCollapse: true,
    paging: false,
  });
});
