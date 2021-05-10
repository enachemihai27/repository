//CUSTOM JS

$('#edit-modal').on('shown.bs.modal', function (event) {
    console.log("aici edit")
    let button = $(event.relatedTarget) // Button that triggered the modal
    let user = button.data('user');
    
    
    console.log(user.id);
    

    let modal = $(this);

    modal.find('#editId').val(user.id);
    modal.find('#editName').text(user.name);
    modal.find('#editRole').val(user.role);



    $(document).on("click", "#save_changes", function () {
        var editId = user.id;
        $.ajax({
            url: '/updateUser',
            type: "GET",
            data: {
                id: editId,
                
            },
            success: function (dataResult) {

                location.reload();
            }
            
        });
    });

    


});

$('#delete-modal').on('shown.bs.modal', function (event) {
    console.log(" aici remove");
    let button = $(event.relatedTarget) // Button that triggered the modal
    let user = button.data('user');
    console.log(user.id);


    $(document).on("click", "#delete", function () {
        var id = user.id
        $.ajax({
            url: '/deleteUser',
            type: 'GET',

            data: { id: id },

            success: function (response) {
                location.reload();
            }

        });

    });

});    