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

// Category modal
$(document).ready(function () {
  // Fill edit modal with values from closest table row
  $('.editBtn').on('click', function () {
    $('#editModal').modal('show');
    $('#name').trigger('focus');

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

  $('#addNewCategoryModal').on('shown.bs.modal', function () {
    $('#aname').trigger('focus');
  });

  // Add-form ajax validation
  $('#add-category-form').submit(function (event) {
    event.preventDefault();
    const name = $('#aname').val();
    const description = $('#adescription').val();
    const ordering = $('#aordering').val();
    const visibility = $('.avisibility:checked').val();
    const comments = $('.acomments:checked').val();
    const ads = $('.aads:checked').val();
    const add = $('#add').val();

    $('#amsg').load('includes/processCategories.php', {
      name: name,
      description: description,
      ordering: ordering,
      visibility: visibility,
      comments: comments,
      ads: ads,
      add: add,
    });
  });

  // Edit-form ajax validation
  $('#edit-category-form').submit(function (event) {
    event.preventDefault();
    const id = $('#id').val();
    const hiddenName = $('#hiddenName').val();
    const name = $('#name').val();
    const description = $('#description').val();
    const ordering = $('#ordering').val();
    const visibility = $('.visibility:checked').val();
    const comments = $('.comments:checked').val();
    const ads = $('.ads:checked').val();
    const update = $('#update').val();

    $('#msg').load('includes/processCategories.php', {
      id: id,
      hiddenName: hiddenName,
      name: name,
      description: description,
      ordering: ordering,
      visibility: visibility,
      comments: comments,
      ads: ads,
      update: update,
    });
  });

  // Delete modal
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

// Items modal
$(document).ready(function () {
  // Fill edit modal with values from closest table row
  $('.editItemBtn').on('click', function () {
    $('#editItemModal').modal('show');
    $('#name').trigger('focus');

    $tr = $(this).closest('tr');
    const data = $tr
      .children('td')
      .map(function () {
        return $(this).text();
      })
      .get();

    const id = $tr.children('th').text();

    $('#id').val(id);
    $('#name').val(data[0]);
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

  $('#addNewItemModal').on('shown.bs.modal', function () {
    $('#aname').trigger('focus');
  });

  // Add-form ajax validation
  $('#add-item-form').submit(function (event) {
    event.preventDefault();
    const name = $('#aname').val();
    const description = $('#adescription').val();
    const price = $('#aprice').val();
    const country = $('#acountry').val();
    const status = $('#astatus').val();
    const category = $('#acategory').val();
    const add = $('#add').val();

    $('#amsg').load('includes/processItems.php', {
      name: name,
      description: description,
      price: price,
      country: country,
      status: status,
      category: category,
      add: add,
    });
  });

  // Edit-form ajax validation
  $('#edit-item-form').submit(function (event) {
    event.preventDefault();
    const id = $('#id').val();
    const name = $('#name').val();
    const description = $('#description').val();
    const price = $('#price').val();
    const country = $('#country').val();
    const status = $('#status').val();
    const category = $('#category').val();
    const update = $('#update').val();

    $('#msg').load('includes/processItems.php', {
      id: id,
      name: name,
      description: description,
      price: price,
      country: country,
      status: status,
      category: category,
      update: update,
    });
  });
});

// Delete review modal
$(document).ready(function () {
  $('.deleteReviewBtn').on('click', function () {
    $tr = $(this).closest('tr');
    const id = $tr.children('th').text();
    $('#deleteID').val(id);
  });
});
