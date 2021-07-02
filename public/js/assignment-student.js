
$(document).on('click', 'tr', function(e) {
    if (e.target.innerText === 'Edit'){
        // $('#studentId option:selected').remove();
        const studentId = $(this).children('.student_id').text();
        const comment = $(this).children('td').children('.t-comment').val();
        const mark = $(this).children('td').children('.t-marks').text();
        const option = $('#studentId option');
        $('#status').prop('checked',true);
        $('#submitBtn').prop('disabled',false);
        if (option.length > 1){
            option[1].remove();
        }
        $('#studentId').append(`
                <option value="${studentId}" selected>${studentId}</option>
            `)
        $('#mark').val(mark);
        $('#comment').val(comment);
    }
}) ;
