<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template name="adminmodal">

      <div class="modal" tabindex="-1" role="dialog" id="adminmodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
              <h4 class="modal-title">User Administration</h4>
            </div>

            <div class="modal-body">
              <table class="table">
                <thead>
                  <tr>
                    <th> Username </th>
                    <th> Password </th>
                    <th> Admin </th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
              </table>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="add">Add new user</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <script src="../vendor/admin.js"></script>

	</xsl:template>

</xsl:stylesheet>