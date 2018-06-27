function getModal(attr){
  var header_color = attr['header']['color'];
  if(header_color === undefined) header_color = "black";

  var header_content = attr['header']['content'];
  if(header_content === undefined) header_content = "null";

  var body_color = attr['body']['color'];
  if(body_color === undefined) body_color = "black";

  var body_content = attr['body']['content'];
  if(body_content === undefined) body_content = "null";

  var customModal = $(`
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
    <h1 style="color:`+header_color+`">`+header_content+`</h1>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <h5 style="color:`+body_color+`">`+body_content+`</h5>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
    </div>
    </div>
    </div>`);
    return customModal;
  }

  function appendModal(customModal) {
    $('body').append(customModal);
    $('#myModal').modal();
    $('#myModal').on('hidden.bs.modal', function () {
      $(this).remove();
    });
  }
