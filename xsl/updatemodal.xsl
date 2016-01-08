<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template name="updatemodal">

    <div class="modal" tabindex="-1" role="dialog" id="updatemodal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            <h4 class="modal-title">Update post</h4>
          </div>

          <div class="modal-body">

            <form class="form-horizontal" id="imageForm">
              <section class="form-group">  
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title"/>
                </div>
              </section>

              <section class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Caption</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="caption"/>
                </div>
              </section>
            </form>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
            <button type="button" class="btn btn-danger" id="delete" data-dismiss="modal" >Delete</button>
            <button type="button" class="btn btn-success" id="save">Save Changes</button>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
  </xsl:template>

</xsl:stylesheet>