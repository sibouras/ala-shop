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

$(document).ready(function () {
  $('.editBtn').on('click', function () {
    $('#editModal').modal('show');

    $tr = $(this).closest('tr');
    const data = $tr
      .children('td')
      .map(function () {
        return $(this).text();
      })
      .get();

    const spans = $tr
      .children('td')
      .children('span')
      .map(function () {
        return $(this).text();
      })
      .get();

    const ordering = $tr.children('th').text();

    $('#ordering').val(ordering);
    $('#id').val(data[0]);
    $('#name').val(data[1]);
    $('#hiddenName').val(data[1]);
    $('#description').val(data[2]);

    if (spans[0] === 'Hidden') {
      $('#vis-yes').prop('checked', false);
      $('#vis-no').prop('checked', true);
    } else {
      $('#vis-yes').prop('checked', true);
      $('#vis-no').prop('checked', false);
    }
    if (spans[0] === 'No Comments' || spans[1] === 'No Comments') {
      $('#com-yes').prop('checked', false);
      $('#com-no').prop('checked', true);
    } else {
      $('#com-yes').prop('checked', true);
      $('#com-no').prop('checked', false);
    }
    if (
      spans[0] === 'No Ads' ||
      spans[1] === 'No Ads' ||
      spans[2] === 'No Ads'
    ) {
      $('#ads-yes').prop('checked', false);
      $('#ads-no').prop('checked', true);
    } else {
      $('#ads-yes').prop('checked', true);
      $('#ads-no').prop('checked', false);
    }
  });
});

$(document).ready(function () {
  $('.deleteBtn').on('click', function () {
    $tr = $(this).closest('tr');
    const data = $tr
      .children('td')
      .map(function () {
        return $(this).text();
      })
      .get();
    $('#deleteID').val(data[0]);
  });
});
