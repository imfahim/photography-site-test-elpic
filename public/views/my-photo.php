<div ng-show="pub_image">
  <div class="well well-sm"><center>Public Images</center></div>
    <div class="row">
      <div class="col-md-6" ng-repeat="image in pbimages | orderBy:'created_at'">
        <div class="panel panel-default">
          <div class="panel-heading"><%image.title%>
            <div class="pull-right">
              <%image.created_at%>
            </div>
          </div>
          <div class="panel-body">
            <img src="http://<%imUrl%>/storage/<%image.user_id%>/<%image.title%>"  style="max-width:100%" alt="">
            Discription:
            <%image.description%>
            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal" ng-click="getId(image.img_id)">Invite</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#76B852">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Invite Friend to Download</center></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-submit="onInvite()">
           <div class="form-group">
             <label class="control-label col-sm-4" for="title">Friend's Email:</label>
             <div class="col-sm-8">
               <input type="email" class="form-control" ng-model="friend.email" placeholder="Enter Email" required>
             </div>
           </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Invite</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="modal_close">Close</button>
        </form>
        </div>
        </div>
      </div>
    </div>
  </div>


  <div ng-show="pri_image">
    <div class="well well-sm"><center>Private Images</center></div>
      <div class="row">
        <div class="col-md-6" ng-repeat="image in primages">
          <div class="panel panel-default">
            <div class="panel-heading"><%image.title%>
              <div class="pull-right">
                <%image.created_at%>
              </div>
            </div>
            <div class="panel-body">
              <img src="http://<%imUrl%>/image/<%image.user_id%>/<%image.title%>" oncontextmenu="return false;" style="max-width:100%" alt="">
              Discription:
              <%image.description%>
              <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal" ng-click="getId(image.img_id)">Invite</button>
            </div>
          </div>
        </div>
      </div>
    </div>
