$(document).ready(function() {
    function handleDeleteConfirmation(selector, customOptions = {}) {
        $(selector).on('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            var defaultOptions = {
                title: 'Are you sure?',
                text: "Do you want to delete this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            };

            var options = {...defaultOptions, ...customOptions};

            Swal.fire(options).then((result) => {
                if (result.isConfirmed) {
                    form[0].submit();
                }
            });
        });
    }

    handleDeleteConfirmation('.delete-form');
});