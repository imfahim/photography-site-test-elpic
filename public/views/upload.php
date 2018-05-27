
<div class="well well-sm"><center>Upload Image</center></div>
<form class="form-horizontal" ng-submit="onUpload()">
 <div class="form-group">
   <label class="control-label col-sm-2" for="title">Title:</label>
   <div class="col-sm-10">
     <input type="text" class="form-control" ng-model="image.title" placeholder="Enter Title" required>
   </div>
 </div>
 <div class="form-group">
   <label class="control-label col-sm-2" for="pwd">Discription:</label>
   <div class="col-sm-10">
     <textarea class="form-control" rows="5" ng-model="image.disc" placeholder="Enter Discription"></textarea>
   </div>
 </div>
 <div class="form-group">
   <label class="control-label col-sm-2" for="pwd">Visibility:</label>
   <div class="col-sm-10">
 <select class="form-control" ng-model="image.status">
   <option value="0">Public</option>
   <option value="1">Private</option>
 </select>
 </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-2" for="file">Image:</label>
  <div class="col-sm-10">
  <div class="custom-file">
    <input type="file" class="custom-file-input" file-model="image.file" required>
  </div>
  </div>
</div>
 <div class="form-group">
   <div class="col-sm-offset-2 col-sm-10">
     <button type="submit" class="btn btn-primary">Upload</button>
   </div>
 </div>
</form>
