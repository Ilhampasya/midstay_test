require('./bootstrap');
require('select2/dist/js/select2.full');

(($) => {
    window.handleDelete = e => {
        if (!confirm('Are you sure?')) {
            e.preventDefault();
        }
    }
    $(() => {
        $('.select2').select2();
    })
})(jQuery)