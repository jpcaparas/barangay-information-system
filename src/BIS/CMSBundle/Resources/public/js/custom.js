(function($) {
    var $editForm =  $('form.form-edit');
    var $deleteForm =  $('form.form-delete');
    $deleteForm.find('button[type="submit"]').addClass('btn btn-block btn-danger');
    $editForm.find('button[type="submit"]').addClass('btn btn-block btn-success');
    $deleteForm.on('submit', function() {
        return confirm('Are you sure you want to delete this record? This process is irreversible.');
    });
}(jQuery));