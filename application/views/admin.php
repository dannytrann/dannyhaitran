<div class="col-xs-offset-1">
    <div class="col-xs-6">
        <form action="admin/post" role="form" method="POST" enctype="multipart/form-data">
            <!--Project Name-->
            <h1>New Project</h1>
            <h2>Name</h2>
            <input type="text" name="name" id="name" required="required" class="input-sm"/>
            <!--Project Description-->
            <br/>
            <h2>Description</h2>
            <input type="text" name="description" id="description" required="required" class="input-lg"/>
            <!--Submit Button-->
            <br/>
            <input type="submit" class="btn btn-lg margintop3" value="submit"/>
        </form>
    </div>
    <div class="col-xs-5">
        <form action="admin/image" role="form" method="POST" enctype="multipart/form-data">
            <!--Image Uploader-->
            <h1>Image Uploader</h1>
            <!--Project ID / Project Selection-->
            <h3>List of projects</h3>
            <ul class="list-group vertical-scroll ">
                {list-of-projects}
                <li class="list-group-item"><span class="badge">{pid}</span>{pname}</li>
                {/list-of-projects}
            </ul>
            <!--Filename / Image Uploader-->
            <h3>Project ID</h3>
            <input type="text" name="pid" id="pid" required="required" class="input-sm"/>
            </br>

            <h3>Image</h3>
            <input type="file" id="pimage" class="margintop3" name="image" accept="image/*">

            </br>
            <input type="submit" class="btn btn-lg margintop3"/>
        </form>
    </div>
</div>
<div>
    
    <form action="logout" role="form" method="POST" enctype="multipart/form-data">
        <input class="btn btn-group-lg" type="submit" value="LOGOUT" />
    </form>
</div>