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

// Edit-Delete category modal
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

// items form validation
// $(document).ready(function () {
//   $('#add_form').on('submit', function (event) {
//     event.preventDefault();
//     if ($('#aname').val() == '') {
//       alert('Name is required');
//     } else if ($('#aprice').val() == '') {
//       alert('Price is required');
//     } else if ($('#acountry').val() == '') {
//       alert('Country is required');
//     } else {
//       $(this).unbind('submit').submit();
//     }
//   });
// });

// Edit-Delete item modal
$(document).ready(function () {
  $('.editItemBtn').on('click', function () {
    $('#editItemModal').modal('show');

    $tr = $(this).closest('tr');
    const data = $tr
      .children('td')
      .map(function () {
        return $(this).text();
      })
      .get();

    console.log(data);
    const id = $tr.children('th').text();

    $('#id').val(id);
    $('#name').val(data[0]);
    $('#hiddenName').val(data[0]);
    $('#description').val(data[1]);
    $('#price').val(data[2]);
    $('#country').val(data[3]);

    $('#select-status select').val(data[5]);
    $('#select-category select').val(data[6]);
  });

  $('.deleteItemBtn').on('click', function () {
    $tr = $(this).closest('tr');
    const id = $tr.children('th').text();
    $('#deleteID').val(id);
  });
});
